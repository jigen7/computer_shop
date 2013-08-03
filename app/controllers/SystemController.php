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

    const STATUS_CLOSE = 'close';
    const STATUS_OPEN = 'open';

    public function index(){
        $data = array();
        $settings = Settings::find(1);
        $data['computer_count'] = $settings->computer_count;
        return View::make('system', array('data' => $data));
    }

    public function timein($comp_id){
        $data = array();
        if(is_null($comp_id)){
            throw new exception ("Missing Computer ID");
        }

        //Search for the target computer
        $target_computer = Status::find($comp_id);
        if(!$target_computer){
            throw new exception ("Computer not found");
        }

        if($target_computer->status == self::STATUS_CLOSE){
            //throw new exception ("Computer Status is Close cannot Time-in");
        }

        $target_computer->status = "close";
        $target_computer->time_in = date("Y-m-d H:i:s", strtotime("now"));
        $target_computer->save();


        //return View::make('system-timein', array('data' => $data));
        return Redirect::to('system/index')->with('message', 'TimeIn Success for Computer '.$comp_id);
    }

    public function timeout(){
        $data = array();
        return View::make('system-timeout', array('data' => $data));
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