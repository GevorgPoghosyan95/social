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
Route::get('/', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('attempt');
Route::get('/logout','LoginController@logout');
Route::get('/create', 'UserController@index');
Route::post('/create', 'UserController@create')->name('create');
Route::middleware(['auth'])->group(function () {
    Route::get('/feed', 'LoginController@personal')->name('personal');
    Route::post('/find', 'UserController@find')->name('find');
    Route::post('/findFriends', 'UserController@findFriends');
    Route::get('/showProfile/{userID}', 'UserController@showProfile');
    Route::post('/friendRequest','UserController@friendRequest')->name('friendRequest');
    Route::post('/showFriends','UserController@showFriends')->name('showFriends');
    Route::resource('posts','PostController');
});

