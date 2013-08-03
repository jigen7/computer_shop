<?php

class SystemController extends BaseController {

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
        $settings = Settings::find(1);
        $data['computer_count'] = $settings->computer_count;
        return View::make('system', array('data' => $data));
    }

	public function showWelcome()
	{
		return View::make('hello');
        /*
                 for($count = 1;$count<=100;$count++){
            $status = new Status;
            $status->id = $count;
            $status->save();
        }
         */
	}


}