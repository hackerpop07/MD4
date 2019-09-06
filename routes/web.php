<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('user')->group(function () {
    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::post('/update/{id}', 'UserController@update')->name('user.update');
    Route::get('/changepassword', 'UserController@viewChangePassword')->name('user.viewChangePassword');
    Route::post('/changepassword', 'UserController@changePassword')->name('user.changePassword');
});

Route::get('login/{provider}', 'SocialController@redirect');
Route::get('login/{provider}/callback', 'SocialController@Callback');
