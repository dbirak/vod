<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use App\Models\User;
use App\Models\Films;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    //admin account blade
    public function admin_account(Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $user_count = User::select('users.id as film')->where('status', '=', 'user')->count();
            $admin_count = User::select('users.id as film')->where('status', '=', 'admin')->count();

            $gatunki = Films::groupBy('genres_id')->select('genres_id', DB::raw('count(*) as gatunek'))->get();

            $col1 = Films::select('films.id')->where('rok_produkcji', '<', '1993')->count();
            $col2 = Films::select('films.id')->whereBetween('rok_produkcji', [1993, 1999])->count();
            $col3 = Films::select('films.id')->whereBetween('rok_produkcji', [2000, 2005])->count();
            $col4 = Films::select('films.id')->whereBetween('rok_produkcji', [2006, 2011])->count();
            $col5 = Films::select('films.id')->whereBetween('rok_produkcji', [2012, 2017])->count();
            $col6 = Films::select('films.id')->where('rok_produkcji', '>', '2017')->count();

            $rok_produkcji = array($col1, $col2, $col3, $col4, $col5, $col6);

            return view('/admin.admin_account', ['user_count' => $user_count, 'admin_count' => $admin_count, 'gatunki' => $gatunki, 'rok_produkcji' => $rok_produkcji]);
        }
        else
        {
            return redirect('/');
        }
    }

    //admins list blade
    public function admins_list(Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $admins = User::select('users.*')->where('status', '=', 'admin')->where('id', '!=', Auth::user()->id)->get();

            return view('/admin.admins_list', ['admins' => $admins]);
        }
        else
        {
            return redirect('/');
        }
    }

    //delete admin
    public function delete_admin($id, Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $count = User::select('users.*')->where('id', '=', $id)->where('status', '=', 'admin')->count();

            if($count > 0)
            {
                User::where('id', '=', $id)->delete();

                return redirect('/admins_list');

            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    //add admin blade
    public function add_admin(Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/admin.add_admin', ['naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
    }

    //add admin form
    public function add_admin_form(Request $request)
    {
        if(!Auth::check() || Auth::user()->status == 'user')
        {
            return redirect('/');
        }
        else
        {
            $request->validate([
                'imie'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż_-]{1,20}$/',
                'nazwisko'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż_-]{1,20}$/',
                'email'=>'required|email|unique:users|max:25',
                'haslo'=>'required|max:20'
            ]);

            if($request->haslo == $request->haslo2)
            {
                $user = new User();
                $user->imie = $request->imie;
                $user->nazwisko = $request->nazwisko;
                $user->email = $request->email;
                $user->password = Hash::make($request->haslo);
                $user->stan_konta = 0;
                $user->status = "admin";
                $res = $user->save();

                if($res)
                {
                    return redirect('/admins_list');
                }
            }
            else
            {
                return back()->with("fail", "Podane hasła są różne!");
            }

        }
    }

    //films list blade
    public function films_list(Request $request, $serach="")
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            if($serach == "")
            {
                $films = Films::select('films.*')->get();

                return view('/admin.films_list', ['films' => $films, 'serach' => $serach]);
            }
            else
            {
                $films = Films::select('films.*')->where('films.tytul', 'like', '%'.$serach.'%')->get();

                return view('/admin.films_list', ['films' => $films, 'serach' => $serach]);
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function films_serach_admin(Request $request)
     {
        if(isset($request->szukaj))
        {
            return redirect('/films_list/'.$request->szukaj);
        }
        elseif(Auth::check() && Auth::user()->status == 'admin')
        {
            return redirect('/films_list');
        }
        else
        {
            return redirect('/');
        }
     }

     //add film blade
     public function add_film(Request $request)
     {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/admin.add_film', ['naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
     }

     // dodawanie filmu
     public function add_film_admin(Request $request)
     {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $request->validate([
                'tytul'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż _-]{1,20}$/',
                'rezyser'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż _-]{1,20}$/',
                'gatunek'=>'required|integer|exists:genres,id',
                'produkcja'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż _-]{1,20}$/',
                'rok_produkcji'=>'required|regex:/^[1-9][0-9]{3,3}$/',
                'czas_trwania'=> ['required', 'regex:/^(([1-9][0-9])|([1-9])){1,2}$/'],
                'ocena'=>'required|regex:/^(\d+\.\d{1,2})$/',
                'opis'=>'required|max:500',
                'link_grafika'=>'required|max:49',
                'link_film'=>'required|max:49',
                'cena'=>'required|max:5|regex:/^[0-9]+(\.[0-9]{1,2})?$/'
            ]);

                $films = new Films();
                $films->tytul = $request->tytul;
                $films->rezyser = $request->rezyser;
                $films->genres_id = $request->gatunek;
                $films->produkcja = $request->produkcja;
                $films->rok_produkcji = $request->rok_produkcji;
                $films->czas_trwania = $request->czas_trwania;
                $films->ocena = $request->ocena;
                $films->opis = $request->opis;
                $films->link_grafika = $request->link_grafika;
                $films->link_film = $request->link_film;
                $films->cena = $request->cena;
                $res = $films->save();

                if($res)
                {
                    return redirect('/films_list');
                }
        }
        else
        {
            return redirect('/');
        }
     }

     //edit film blade
     public function edit_film($id, Request $request)
     {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $film = Films::select('films.*')->where('id', '=', $id)->get();

            if(count($film) == 0) return redirect('/');

            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/admin.edit_film', ['film' => $film,'naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
     }

     //edit film blade
     public function edit_film_admin($id, Request $request)
     {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $count = Films::select('films.id')->where('id', '=', $id)->count();

            if($count == 1)
            {
                $request->validate([
                    'tytul'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż _-]{1,20}$/',
                    'rezyser'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż _-]{1,20}$/',
                    'gatunek'=>'required|integer|exists:genres,id',
                    'produkcja'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż _-]{1,20}$/',
                    'rok_produkcji'=>'required|regex:/^[1-9][0-9]{3,3}$/',
                    'czas_trwania'=> ['required', 'regex:/^(([1-9][0-9])|([1-9])){1,2}$/'],
                    'ocena'=>'required|regex:/^(\d+\.\d{1,2})$/',
                    'opis'=>'required|max:500',
                    'link_grafika'=>'required|max:49',
                    'link_film'=>'required|max:49',
                    'cena'=>'required|max:5|regex:/^[0-9]+(\.[0-9]{1,2})?$/'
                ]);


                $films = new Films();
                $films->exists = true;
                $films->id = $id;
                $films->tytul = $request->tytul;
                $films->rezyser = $request->rezyser;
                $films->genres_id = $request->gatunek;
                $films->produkcja = $request->produkcja;
                $films->rok_produkcji = $request->rok_produkcji;
                $films->czas_trwania = $request->czas_trwania;
                $films->ocena = $request->ocena;
                $films->opis = $request->opis;
                $films->link_grafika = $request->link_grafika;
                $films->link_film = $request->link_film;
                $films->cena = $request->cena;
                $res = $films->save();

                if($res)
                {
                    return redirect('/films_list');
                }
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
     }

    //delete film
    public function delete_film($id, Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $count = Films::select('films.*')->where('id', '=', $id)->count();

            if($count > 0)
            {
                Loans::where('films_id', '=', $id)->delete();

                Films::where('id', '=', $id)->delete();

                return redirect('/films_list');

            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    //users list blade
    public function users_list(Request $request, $serach="")
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            if($serach == "")
            {
                $users = User::select('users.*')->where('status', '=', 'user')->get();

                return view('/admin.users_list', ['users' => $users, 'serach' => $serach]);
            }
            else
            {
                $users = User::select('users.*')->where('status', '=', 'user')->where(function ($query) use ($serach) {$query->where('imie', 'like', '%'.$serach.'%')->orwhere('nazwisko', 'like', '%'.$serach.'%')->orwhere('email', 'like', '%'.$serach.'%');})->get();

                return view('/admin.users_list', ['users' => $users, 'serach' => $serach]);
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function users_serach_admin(Request $request)
    {
        if(isset($request->szukaj))
        {
            return redirect('/users_list/'.$request->szukaj);
        }
        elseif(Auth::check() && Auth::user()->status == 'admin')
        {
            return redirect('/users_list');
        }
        else
        {
            return redirect('/');
        }
    }

    //delete user
    public function delete_user($id, Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'admin')
        {
            $count = User::select('users.*')->where('id', '=', $id)->where('status', '=', 'user')->count();

            if($count > 0)
            {
                Loans::where('user_id', '=', $id)->delete();

                User::where('id', '=', $id)->delete();

                return redirect('/users_list');

            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }
}
