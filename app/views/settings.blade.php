@extends('layout')

@section('content')
<span class="pageHeader">Settings</span>
<br><br>
<form method="put">
<table>
	<tr>
		<td>Number of Computer : </td>
		<td><input type="text" id="computer_number" name="computer_number" size="5" value="<?php echo $data['computer_num']?>">
	</tr>
	<tr>
		<td>Price Per Minute : </td>
		<td><input type="text" id="price_per_min" name="price_per_min" size="5" value="<?php echo $data['price_per_min'] ?>">
	</tr>
	<tr>
		<td colspan=2><?php echo Form::submit('Submit');?></td>
	</tr>
</table>


</form>

@stop