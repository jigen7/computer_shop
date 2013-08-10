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
Route::get('system/index', 'SystemController@Index');
Route::get('system/timein/comp_id/{comp_id}', 'SystemController@Timein');
Route::get('system/timeout/comp_id/{comp_id}', 'SystemController@Timeout');
Route::get('system/computeinitial/comp_id/{comp_id}', 'SystemController@ComputeInitial');
Route::get('reports', 'ReportController@Index');
Route::get('settings', 'SettingsController@Index');
Route::get('settings/index', 'SettingsController@Index');


