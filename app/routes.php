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

Route::group(array('namespace' => 'Ironquest\Controllers'), function()
{
    //HOME
    Route::get('/', array('as' => 'home.index', 'uses' => 'HomeController@show'));

    //DASHBOARD
    Route::get('/dashboard', array('as' => 'dashboard.show', 'uses' => 'DashboardController@show'));

    //DIRECTORY
    Route::get('/rules', array('as' => 'directory.show', 'uses' => 'DirectoryController@show'));

    //MILESTONES
    Route::resource('milestones', 'MilestoneController');

    //USER
    Route::get('/login', array('as' => 'user.login', 'uses' => 'UserController@login'));
    Route::post('/login', array('as' => 'users.processLogin', 'uses' => 'UserController@processLogin'));
    Route::get('/logout', array('as' => 'users.logout', 'uses' => 'UserController@logout'));
    Route::get('/users/destroy/{id}', array('as' => 'user.destroy', 'uses' => 'UserController@destroy'));
    Route::get('/users/revive/{id}', array('as' => 'user.revive', 'uses' =>'UserController@revive'));
    Route::resource('users', 'UserController');
    Route::get('/denied', array('as' => 'denied', function()
    {
        return View::make('denied');
    }));
});