<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@show');

Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', 'UserController@processLogin');
Route::get('/logout', 'UserController@logout');

Route::resource('user', 'UserController');

Route::get('/denied', array('as' => 'denied', function()
{
    return View::make('denied');
}));