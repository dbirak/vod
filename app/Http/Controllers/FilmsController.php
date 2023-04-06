<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use App\Models\User;
use App\Models\Films;
use App\Models\Genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FilmsController extends Controller
{
    //index blade
    public function index()
    {
        //najnowsze filmy
        $naj_film = Films::orderByDesc('films.id')->limit(8)->get();

        //nasz wybór
        $nas_wyb = Films::orderByDesc('films.rok_produkcji')->limit(8)->get();

        //najwyzej oceniane
        $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();


        return view('index', ['naj_film' => $naj_film, 'nas_wyb' => $nas_wyb, 'naj_oce' => $naj_oce]);
    }

    //film blade
    public function film($id, Request $request)
    {
        //konkretny film
        $film = Films::select('films.*')->where('films.id', '=', $id)->get();

        if(count($film) == 0)
        {
            return redirect('/');
        }

        //najwyzej oceniane
        $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

        if(Auth::check() && Auth::user()->status == 'user')
        {
            $check = false;

            //$row = Loans::select('loans.*')->join('films', 'loans.films_id', '=', 'films.id')->join('users', 'loans.user_id', '=', 'users.id')->where('loans.user_id', '=', $request->session()->get('id'))->where('loans.films_id', '=', $id)->get();

            $row = Loans::select('loans.*')->where('user_id', '=', Auth::user()->id)->where('films_id', '=', $id)->get();

            $data_zak2 = "";

            if(count($row) > 0)
            {
                    date_default_timezone_set('CET');
                    $data_zak = date("Y-m-d H:i:s", strtotime($row[count($row)-1]->data_zakonczenia));
                    $current = date('Y-m-d H:i:s', strtotime("+0 day"));

                    if($data_zak >= $current)
                    {
                        $check = true;

                        $data_zak2 = date("H:i    d.m.Y", strtotime($row[count($row)-1]->data_zakonczenia));
                    }
            }

            return view('film_user', ['film' => $film, 'naj_oce' => $naj_oce, 'check' => $check, 'row' => $row, 'data_zak2' => $data_zak2]);

        }
        else if(Auth::check() && Auth::user()->status == 'admin')
        {
            return view('film_admin', ['film' => $film, 'naj_oce' => $naj_oce]);
        }
        else
        {
            return view('film', ['film' => $film, 'naj_oce' => $naj_oce]);
        }
    }

    //kupno filmu
    public function buy($id, Request $request)
    {
        if(Auth::check() && Auth::user()->status == "user")
        {
            $cena = Films::select('films.cena')->where('films.id', '=', $id)->get();

            if(count($cena) == 0)
            {
                return redirect('/');
            }

            if(Auth::user()->stan_konta >= $cena[0]->cena)
            {
                $loans = new Loans();
                $loans->user_id = Auth::user()->id;
                $loans->films_id = $id;
                date_default_timezone_set('CET');
                $loans->data_zakonczenia = date('Y-m-d H:i:s', strtotime("+2 day"));
                $res = $loans->save();

                if($res)
                {
                    $nowy_stan_konta = Auth::user()->stan_konta - $cena[0]->cena;

                    $res2 = User::where("id", Auth::user()->id)->update(["stan_konta" => $nowy_stan_konta]);

                    /*$request->session()->put('stan_konta', $nowy_stan_konta);*/

                    return redirect("/film/".$id);
                }
            }
            else
            {
                return redirect('/recharge');
            }
        }
        else if(Auth::check() && Auth::user()->status == "admin")
        {
            return redirect("/film/".$id);
        }
        else
        {
            return redirect("/login");
        }
    }

     //wszystkie filmy blade
     public function films($serach="")
     {
        if($serach == "")
        {
            $films = Films::select('films.*')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "akcja")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '1')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "horror")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '2')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "fantasy")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '3')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "animowany")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '4')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "dreszczowiec")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '5')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "komedia")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '6')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "wojenny")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '7')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else if($serach == "przygodowy")
        {
            $films = Films::select('films.*')->where('genres_id', '=', '8')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
        else
        {
            $films = Films::select('films.*')->where('tytul', 'like', '%'.$serach.'%')->get();

            return view("/films", ['serach' => $serach, 'films' => $films]);
        }
     }

     public function films_serach(Request $request)
     {
        if(isset($request->szukaj))
        {
            return redirect('/films/'.$request->szukaj);
        }
        else
        {
            return redirect('/films');
        }
     }

    //about blade
     public function about()
     {
        return view('/about');
     }
}
