<?php

namespace App\Http\Controllers;

use App\Models\Films;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Loans;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //login blade
    public function login(Request $request)
    {
        if(Auth::check())
        {
            return redirect('/');
        }
        else
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('login', ['naj_oce' => $naj_oce]);
        }
    }

    //logowanie do serwisu
    public function login_user(Request $request)
    {
        if(Auth::check())
        {
            return redirect('/');
        }
        else
        {
            $credentials = $request->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]);


                    /*$request->session()->put('id', $user->id);
                    $request->session()->put('imie', $user->imie);
                    $request->session()->put('nazwisko', $user->nazwisko);
                    $request->session()->put('email', $user->email);
                    $request->session()->put('stan_konta', $user->stan_konta);
                    $request->session()->put('status', $user->status);*/

                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();

                        return redirect('/');
                    }


                    return back()->withErrors([
                        'email' => 'Niepoprawny email lub hasło!',
                    ])->onlyInput('email');
        }
    }

    //register blade
    public function register(Request $request)
    {
        if(Auth::check())
        {
            return redirect('/');
        }
        else
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('register', ['naj_oce' => $naj_oce]);
        }
    }

    //rejestracja w serwisie
    public function register_user(Request $request)
    {
        if(Auth::check())
        {
            return redirect('/');
        }
        else
        {
            $request->validate([
                'imie'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż_-]{1,20}$/',
                'nazwisko'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż_-]{1,20}$/',
                'email'=>'required|email|unique:users|max:25',
                'password'=>'required|max:20'
            ]);

            if($request->password == $request->haslo2)
            {
                $user = new User();
                $user->imie = $request->imie;
                $user->nazwisko = $request->nazwisko;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->stan_konta = 0;
                $user->status = "user";
                $res = $user->save();

                if($res)
                {

                    /*$new_user = User::where('email', '=', $request->email)->get();

                    $request->session()->put('id', $new_user[0]->id);
                    $request->session()->put('imie', $new_user[0]->imie);
                    $request->session()->put('nazwisko', $new_user[0]->nazwisko);
                    $request->session()->put('email', $new_user[0]->email);
                    $request->session()->put('stan_konta', $new_user[0]->stan_konta);
                    $request->session()->put('status', $new_user[0]->status);*/

                    $credentials = $request->validate([
                        'email'=>'required|email|max:25',
                        'password'=>'required|max:20'
                    ]);

                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();

                        return redirect('/');
                    }
                }
            }
            else
            {
                return back()->with("fail", "Podane hasła są różne!");
            }

        }
    }

    //Wylogoanie
    public function logout(Request $request)
    {
        if(Auth::check())
        {
            Auth::logout();
            return redirect('/login');
        }
        else
        {
            return redirect('/');
        }
    }

    //konto usera blade
    public function my_account(Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'user')
        {
            date_default_timezone_set('CET');
            $current_date = date('Y-m-d H:i:s', strtotime("+0 day"));

            $wypozyczone = Loans::select('loans.*')->where('loans.user_id', '=', Auth::user()->id)->where('data_zakonczenia', '>', $current_date)->get();

            return view('/user.my_account', ['wypozyczone' => $wypozyczone]);
        }
        else
        {
            return redirect('/');
        }
    }

    //edycja emailu blade
    public function edit_email(Request $request)
    {
        if(Auth::check())
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/user.edit_email', ['naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
    }

    //edycja emailu
    public function edit_email_user(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/');
        }
        else
        {

                $request->validate([
                    'email'=>'required|email|unique:users|max:25'
                ]);

                $user = new User();
                $user->exists = true;
                $user->id = Auth::user()->id;
                $user->email = $request->email;
                $res = $user->save();

                if($res)
                {
                    /*$new_user = User::where('email', '=', $request->email)->get();

                    $request->session()->put('id', $new_user[0]->id);
                    $request->session()->put('imie', $new_user[0]->imie);
                    $request->session()->put('nazwisko', $new_user[0]->nazwisko);
                    $request->session()->put('email', $new_user[0]->email);
                    $request->session()->put('stan_konta', $new_user[0]->stan_konta);
                    $request->session()->put('status', $new_user[0]->status);*/

                    if(Auth::user()->status == "user")
                    {
                        return redirect('/my_account');
                    }
                    else if (Auth::user()->status == "admin")
                    {
                        return redirect('/admin_account');
                    }

                }
        }
    }

    //edycja hasla blade
    public function change_password(Request $request)
    {
        if(Auth::check())
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/user.change_password', ['naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
    }

    //edycja hasła
    public function change_password_user(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/');
        }
        else
        {

            $user = User::where('email', '=', Auth::user()->email)->first();

            $request->validate([
                'haslo'=>'required|max:20',
                'haslo2'=>'required|max:20',
                'haslo3'=>'required|max:20'
            ]);

                if(Hash::check($request->haslo, $user->password))
                {

                    if($request->haslo2 == $request->haslo3)
                    {
                        $user = new User();
                        $user->exists = true;
                        $user->id = Auth::user()->id;
                        $user->password = Hash::make($request->haslo2);
                        $res = $user->save();

                        if($res)
                        {
                            /*$new_user = User::where('email', '=', Auth::user()->email)->get();

                            $request->session()->put('id', $new_user[0]->id);
                            $request->session()->put('imie', $new_user[0]->imie);
                            $request->session()->put('nazwisko', $new_user[0]->nazwisko);
                            $request->session()->put('email', $new_user[0]->email);
                            $request->session()->put('stan_konta', $new_user[0]->stan_konta);
                            $request->session()->put('status', $new_user[0]->status);*/

                            if(Auth::user()->status == "user")
                            {
                                return redirect('/my_account');
                            }
                            else if (Auth::user()->status == "admin")
                            {
                                return redirect('/admin_account');
                            }

                        }


                     }
                     else
                     {
                        return back()->with("fail", "Podane hasła są różne!");
                     }

                }
                else
                {
                    return back()->with("fail", "Obecne hasło jest nieprawdziwe!");
                }

        }
    }

    //doładowanie konta blade
    public function recharge(Request $request)
    {
        if(Auth::check() && Auth::user()->status == 'user')
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/user.recharge', ['naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
    }

    //doładowanie konta
    public function recharge_user(Request $request)
    {
        if(!Auth::check() || Auth::user()->status == 'admin')
        {
            return redirect('/');
        }
        else
        {
                $request->validate([
                    'kwota'=>'required|max:7|regex:/^[0-9]+(\.[0-9]{1,2})?$/'
                ]);

                $nowy_stan_konta =  Auth::user()->stan_konta + $request->kwota;

                $user = new User();
                $user->exists = true;
                $user->id = Auth::user()->id;
                $user->stan_konta = $nowy_stan_konta;
                $res = $user->save();

                if($res)
                {
                    /*$new_user = User::where('email', '=', Auth::user()->email)->get();

                    $request->session()->put('id', $new_user[0]->id);
                    $request->session()->put('imie', $new_user[0]->imie);
                    $request->session()->put('nazwisko', $new_user[0]->nazwisko);
                    $request->session()->put('email', $new_user[0]->email);
                    $request->session()->put('stan_konta', $new_user[0]->stan_konta);
                    $request->session()->put('status', $new_user[0]->status);*/

                    if(Auth::user()->status == "user")
                    {
                        return redirect('/my_account');
                    }
                    else if (Auth::user()->status == "admin")
                    {
                        return redirect('/admin_account');
                    }

                }
        }
    }

    //usuniecie konta blade
    public function delete_account(Request $request)
    {
        if(Auth::check())
        {
            Loans::where('user_id', '=', Auth::user()->id)->delete();

            User::where('id', '=', Auth::user()->id)->delete();

            Auth::logout();

            return redirect('/login');
        }
        else
        {
            return redirect('/');
        }
    }

    //edycja danych blade
    public function edit_name(Request $request)
    {
        if(Auth::check())
        {
            //najwyzej oceniane
            $naj_oce = Films::orderByDesc('films.ocena')->limit(8)->get();

            return view('/user.edit_name', ['naj_oce' => $naj_oce]);
        }
        else
        {
            return redirect('/');
        }
    }

    //edycja danych konta
    public function edit_name_user(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/');
        }
        else
        {

                $request->validate([
                    'imie'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż_-]{1,20}$/',
                    'nazwisko'=>'required|max:20|regex:/^[a-zA-ZĄ-ŻĄąĆćĘęŁłŃńÓóŚśŹźŻż_-]{1,20}$/'
                ]);

                $user = new User();
                $user->exists = true;
                $user->id = Auth::user()->id;
                $user->imie = $request->imie;
                $user->nazwisko = $request->nazwisko;
                $res = $user->save();

                if($res)
                {
                    /*$new_user = User::where('email', '=', Auth::user()->email)->get();

                    $request->session()->put('id', $new_user[0]->id);
                    $request->session()->put('imie', $new_user[0]->imie);
                    $request->session()->put('nazwisko', $new_user[0]->nazwisko);
                    $request->session()->put('email', $new_user[0]->email);
                    $request->session()->put('stan_konta', $new_user[0]->stan_konta);
                    $request->session()->put('status', $new_user[0]->status);*/

                    if(Auth::user()->status == "user")
                    {
                        return redirect('/my_account');
                    }
                    else if (Auth::user()->status == "admin")
                    {
                        return redirect('/admin_account');
                    }

                }
        }
    }
}
