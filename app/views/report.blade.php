@extends('layout')

@section('content')
{{ HTML::style('css/table-report.css'); }}
<script>
 $(function() {
$( "#datepickerFrom" ).datetimepicker();
$( "#datepickerTo" ).datetimepicker();
});
</script>
<span class="pageHeader">Reports</span><br><br>
<form method="put">
Date From: <input type="text" id="datepickerFrom" name="datepickerFrom" /> - Date To: <input type="text" id="datepickerTo" name="datepickerTo"/><?php echo Form::submit('Submit');?>
<br><br>
<b>Date From</b> : {{ date("m/d/y h:i:s a", strtotime($data['start_date'])) }}  -> <b>Date To</b> : {{ date("m/d/y h:i:s a", strtotime($data['end_date'])) }}  <br>
<?php if($data['logs']) { ?>
<b>Total Earned</b> : P{{ $data['total_sum'] }} <br>
<?php }else {  ?>
<b>No Data to Report</b>
<?php } ?>
<table class="bordered">
    <thead>
	<tr>
        <th>#</th>        
        <th>Com #</th>
        <th>Time-In</th>
		<th>Time-Out</th>
		<th>Time Spent</th>
		<th>Total</th>
		<th>Deduct Mins</th>
		<th>Deduct Total</th>
		<th>Override</th>
		<th>Date Created</th>
    </tr>
    </thead>
	<?php if( $data['logs'] ) { $x=0;  foreach ($data['logs'] as $logs) {  
	$x++;
	?>
    <tr>
        <td>{{ $x }}</td>        
        <td>{{ $logs->computer_no }}</td>
        <td>{{ date("h:i:s a", strtotime($logs->timein)) }}</td>
		<td>{{ date("h:i:s a", strtotime($logs->timeout)) }}</td>
		<td>{{ $logs->time_spent }}</td>
		<td>P{{ $logs->total_payment }}</td>
		<td>{{ $logs->deduct_minutes }}</td>
		<td>{{ $logs->deduct_total }}</td>
		<td>{{ $logs->override }}</td>
		<td>{{ date("m/d/y h:i:s: a", strtotime($logs->date_created)) }}</td>
    </tr>        
	<?php } } ?>
</table>
</form>
@stop