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

//HOME
Route::get('/', 'HomeController@show');

//DASHBOARD
Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@show'));

//DIRECTORY
Route::get('/rules', array('as' => 'rules', 'uses' => 'DirectoryController@show'));

//MILESTONES
Route::resource('milestones', 'MilestoneController');

//USER
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', 'UserController@processLogin');
Route::get('/logout', 'UserController@logout');
Route::get('users/destroy/{id}', 'UserController@destroy');
Route::get('users/revive/{id}', 'UserController@revive');
Route::resource('users', 'UserController');

Route::get('/denied', array('as' => 'denied', function()
{
    return View::make('denied');
}));

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

//MILESTONE
Route::get('api/v1/milestones', 'api\v1\MilestoneApiController@index');
Route::get('api/v1/milestones/{id}', 'api\v1\MilestoneApiController@show');

//USER
Route::get('api/v1/users', 'api\v1\UserApiController@index');
Route::get('api/v1/users/{id}', 'api\v1\UserApiController@show');
Route::post('api/v1/users/{id}', 'api\v1\UserApiController@authenticate');
Route::put('api/v1/users/{id}', 'api\v1\UserApiController@deauthenticate');