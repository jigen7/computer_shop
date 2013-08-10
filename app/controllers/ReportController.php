<?php

class ReportController extends BaseController {

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
        $start_date = Input::get('datepickerFrom');
        $end_date = Input::get('datepickerTo');
        $data = array();
        $data['logs'] = null;
        $now = date("Y-m-d H:i:s", strtotime("now"));
        if($start_date == null){
            //exit
            //return View::make('report', array('data' => $data));
            $start_date = date("Y-m-d 00:01:00", strtotime($now));
        }
        if($end_date == null){
            $end_date = date("Y-m-d 23:59:59", strtotime($now));
        }

        $start_date = date("Y-m-d H:i:s", strtotime($start_date));
        $end_date = date("Y-m-d H:i:s", strtotime($end_date));

        $data['logs'] = DB::table('logs')
            ->whereBetween('date_created', array($start_date, $end_date))->orderBy('date_created', 'asc')->get();

        //Get Total for the day
        $sum = 0;
        foreach($data['logs'] as $logs){
            $sum+= $logs->total_payment;
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['total_sum'] = $sum;
        return View::make('report', array('data' => $data));
    }
	public function showWelcome()
	{
		return View::make('hello');
	}

}