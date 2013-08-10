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
        $openStatus = array();
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
            }else{
                $open_computer_nos[] = $status->id;
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
        $data['open_computer_nos'] = $open_computer_nos;
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
        //Hidden Fields & Input
       // $data['comp_id'] = Input::get('timeoutID');
        $data['now'] = Request::Input('hiddenNow');
        $data['timein'] = Request::Input('hiddenTimein');
        $data['currentTime'] = Request::Input('hiddenCurrentTime');
        $data['total_price'] = Request::Input('hiddenTotalPrice');
        $data['diff_min'] = Request::Input('diff_min');
        $data['diff_total'] = Request::Input('diff_total');
        $data['diff_override'] = Request::Input('diff_override');


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
        $logs = new LogsReport();
        $logs->computer_no = $comp_id;
        $logs->timein = $target_computer->time_in;
       // $logs->timeout = date("h:i:s", strtotime("now"));
        $logs->timeout = $data['now'];
        $logs->total_payment = $data['total_price'];
        $logs->time_spent = $data['currentTime'];;
        $logs->deduct_minutes =  $data['diff_min'];
        $logs->deduct_total =  $data['diff_total'];
        $logs->override =  $data['diff_override'];
        $logs->date_created = date("Y-m-d H:i:s", strtotime("now"));
        $logs->save();

        $target_computer->status = self::STATUS_OPEN;
        $target_computer->time_in = null;
        $target_computer->save();

        //var_dump($data);

        //return View::make('system-timein', array('data' => $data));
        return Redirect::to('system/index')->with('message', 'TimeOut Success for Computer '.$comp_id);
    }

    public function computeinitial($comp_id){
        $deduct_minutes = Input::get('deductMins',0);
        $deduct_total = Input::get('deductTotal',0);
        $override = Input::get('deductOverride',0);
        $params = array();
        $now = date("Y-m-d H:i:s", strtotime("now"));

        $current_time_final = null;
        $computed_total_final = 0;

        $target_computer = Status::find($comp_id);
        $settings = Settings::find(1);
        $current_time = self::otherDiffDate($target_computer->time_in,$now);
        $computed = self::computePrice($current_time,$settings);
        $computed_total_final = $computed;
        //Compute Total Price Deduct Mins
        if($deduct_minutes > 0){
            $current_time_final = date("h:i:s",strtotime("-".$deduct_minutes." minutes",strtotime($current_time)));
            $computed_total_final = self::computePrice($current_time_final,$settings);
        }

        if($deduct_total > 0){
            $computed_total_final = $computed_total_final - $deduct_total;
        }

        if($override > 0){
            $computed_total_final = $override;
        }

        $params['time_in'] = date("h:i:s a", strtotime($target_computer->time_in));
        $params['now'] = $now;
        $params['current'] = $current_time;
        $params['computed'] = $computed;
        $params['deductMin'] = $deduct_minutes;
        $params['deductTotal'] = $deduct_total;
        $params['override'] = $override;
        $params['current_time_final'] = $current_time_final;
        $params['computedTotalFinal'] = $computed_total_final;
        return $params;

    }



    function computePrice($current,$settings){
           $per_min = $settings->price_per_minute;
           $total_minutes = self::convertMinutes($current);
           return $per_min * $total_minutes;
    }

    function convertMinutes($current){
        $minutes = 0;
        if (strpos($current, ':') !== false)
        {
            // Split hours and minutes.
            list($hours, $minutes,$seconds) = explode(':', $current);
        }
        return $hours * 60 + $minutes;
    }//convertMinutes

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