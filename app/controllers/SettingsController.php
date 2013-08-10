<?php

class SettingsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
    public function index(){

        $com_count = Input::get('computer_number');
        $price_per_min = Input::get('price_per_min');
        $data = array();
        $settings = Settings::find(1);

        if($com_count != null || $price_per_min != null){
            $settings->computer_count = $com_count;
            $settings->price_per_minute = $price_per_min;
            $settings->save();
            return Redirect::to('settings/index')->with('message', 'Successfully Save the Settings');
        }

        $data['computer_num'] = $settings->computer_count;
        $data['price_per_min'] = $settings->price_per_minute;
        return View::make('settings', array('data' => $data));

        //return Redirect::to('system/index')->with('message', 'TimeIn Success for Computer '.$comp_id);

    }

	public function showWelcome()
	{
		return View::make('hello');
	}

}