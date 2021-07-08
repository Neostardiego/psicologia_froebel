<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if(auth()->check()){
        return view('quotes.index');
    }else{
        return view('auth.login');
    }
   
});

Auth::routes();
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/quotes', 'QuotesController@index')->name('quotes');
Route::get('quotes', 'QuotesController@index')->name('quotes');
Route::post('quotes', 'QuotesController@store');
Route::get('quotes/records', 'QuotesController@records');
Route::get('quotes/columns', 'QuotesController@columns');
Route::get('quotes/tables', 'QuotesController@tables');
Route::get('quotes/record/{id}', 'QuotesController@record');
Route::get('quotes/filter', 'QuotesController@filter');
Route::get('quotes/exportar', 'QuotesController@exportar');
//Route::get('quotes/type', 'QuotesController@type');
Route::delete('quotes/{id}', 'QuotesController@delete');
