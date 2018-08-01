<?php

use App\User as User;
use App\Role as Role;



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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('checkRole:administrator');;
Route::get('/users',  ['as' => 'users.list', 'uses' => 'UserController@index'])->middleware('checkRole:administrator');
Route::get('/users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('/users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::get('/ping', 'PingController@index')->name('ping');
Route::post('/ping', 'PingController@ping');
Route::get('/nslookup', 'NslookupController@index')->name('nslookup');
Route::post('/nslookup', 'NslookupController@nslookup');
Route::get('/whois', 'WhoisController@index')->name('whois');
Route::post('/whois', 'WhoisController@whois');



