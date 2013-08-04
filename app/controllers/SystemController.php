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

        $computer_status = Status::all();
        $computer_status_array = array();
        $count = 1;

        $now = date("Y-m-d H:i:s", strtotime("now"));
        foreach($computer_status as $status){
            $is_close = 1;
            if($status->time_in){
            $time_in = date("h:i:s a", strtotime($status->time_in));
            }else{
                $time_in = "";
            }

            if($status->status == self::STATUS_OPEN){
                $time_in = "";
                $is_close = 0;
            }

            $computer_status_array[$count]['id'] = $status->id;
            $computer_status_array[$count]['time_in'] = $time_in;
            $computer_status_array[$count]['current_time'] = self::otherDiffDate($time_in,$now);
            $computer_status_array[$count]['status'] = $status->status;
            $computer_status_array[$count]['is_close'] = $is_close;
            $count++;
        }

        $data['computer_status'] = $computer_status_array;
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

        $target_computer->status = self::STATUS_CLOSE;
        $target_computer->time_in = date("Y-m-d H:i:s", strtotime("now"));
        $target_computer->save();


        //return View::make('system-timein', array('data' => $data));
        return Redirect::to('system/index')->with('message', 'TimeIn Success for Computer '.$comp_id);
    }

    public function timeout($comp_id){
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

        $target_computer->status = self::STATUS_OPEN;
        $target_computer->time_in = null;
        $target_computer->save();


        //return View::make('system-timein', array('data' => $data));
        return Redirect::to('system/index')->with('message', 'TimeOut Success for Computer '.$comp_id);
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

    function otherDiffDate($in,$now, $out_in_array=false){
        $intervalo = date_diff(date_create($in), date_create($now));
        //$out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
        $out = $intervalo->format("%H:%I:%S");
        if(!$out_in_array)
            return $out;
        $a_out = array();
        array_walk(explode(',',$out),
            function($val,$key) use(&$a_out){
                $v=explode(':',$val);
                $a_out[$v[0]] = $v[1];
            });
        return $a_out;
    }



}