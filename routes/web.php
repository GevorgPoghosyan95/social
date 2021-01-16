<?php

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

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('attempt');
Route::get('/logout','LoginController@logout');
Route::get('/create', 'UserController@index');
Route::post('/create', 'UserController@create')->name('create');
Route::middleware(['auth'])->group(function () {
    Route::get('/personal', 'LoginController@personal')->name('personal');
    Route::post('/find', 'UserController@find')->name('find');
    Route::get('/showProfile/{userID}', 'UserController@showProfile');
    Route::post('/friendRequest','UserController@friendRequest')->name('friendRequest');
});

