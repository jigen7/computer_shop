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

Route::get('/', function()
{
	return View::make('hello');
});

/*
Route::get('system', function()
{
    return View::make('system');
});
*/

Route::get('home', 'SystemController@Index');
Route::get('system', 'SystemController@Index');
Route::get('report', 'ReportController@Index');
Route::get('settings', 'SettingsController@Index');


