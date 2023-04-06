<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Films;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoansController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(FilmsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/film/{id}', 'film');
    Route::get('/buy/{id}', 'buy');
    Route::get('/films', 'films');
    Route::get('/films/{serach}', 'films');
    Route::post('/films_serach', 'films_serach');
    Route::get('/films_serach', 'films_serach');
    Route::get('/about', 'about');
});

Route::controller(Controller::class)->group(function () {
    Route::get('/login', 'login');
    Route::post('/login_user', 'login_user');
    Route::get('/login_user', 'login_user');
    Route::get('/logout', 'logout');
    Route::get('/register', 'register');
    Route::post('/register_user', 'register_user');
    Route::get('/register_user', 'register_user');
    Route::get('/my_account', 'my_account');
    Route::get('/edit_email', 'edit_email');
    Route::post('/edit_email_user', 'edit_email_user');
    Route::get('/edit_email_user', 'edit_email_user');
    Route::get('/change_password', 'change_password');
    Route::post('/change_password_user', 'change_password_user');
    Route::get('/change_password_user', 'change_password_user');
    Route::get('/recharge', 'recharge');
    Route::post('/recharge_user', 'recharge_user');
    Route::get('/recharge_user', 'recharge_user');
    Route::get('/delete_account', 'delete_account');
    Route::get('/edit_name', 'edit_name');
    Route::post('/edit_name_user', 'edit_name_user');
    Route::get('/edit_name_user', 'edit_name_user');
});

Route::controller(LoansController::class)->group(function () {
    Route::get('/admin_account', 'admin_account');
    Route::get('/admins_list', 'admins_list');
    Route::get('/delete_admin/{id}', 'delete_admin');
    Route::get('/add_admin', 'add_admin');
    Route::post('/add_admin_form', 'add_admin_form');
    Route::get('/add_admin_form', 'add_admin_form');
    Route::get('/films_list', 'films_list');Route::get('/films_list/{serach}', 'films_list');
    Route::post('/films_serach_admin', 'films_serach_admin');
    Route::get('/films_serach_admin', 'films_serach_admin');
    Route::get('/add_film', 'add_film');
    Route::post('/add_film_admin', 'add_film_admin');
    Route::get('/add_film_admin', 'add_film_admin');
    Route::get('/edit_film/{id}', 'edit_film');
    Route::post('/edit_film_admin/{id}', 'edit_film_admin');
    Route::get('/edit_film_admin/{id}', 'edit_film_admin');
    Route::get('/delete_film/{id}', 'delete_film');
    Route::get('/users_list', 'users_list');
    Route::get('/users_list/{serach}', 'users_list');
    Route::post('/users_serach_admin', 'users_serach_admin');
    Route::get('/users_serach_admin', 'users_serach_admin');
    Route::get('/delete_user/{id}', 'delete_user');


    Route::get('/greeting', function () {
        return Auth::user()->status;
        });
});
