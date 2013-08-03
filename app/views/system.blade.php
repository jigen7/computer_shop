@extends('layout')

@section('content')
<div id="leftTable" style="width:400px;position:absolute;left:0;">
			<table class="systemTable">
				<th>Computer #</th>
				<th>Time-In</th>
				<th>Current Time</th>
				<th>Status</th>		
				<?php 
				  for($count=1;$count<=$data['computer_count'];$count++){ 
				 ?>
					<tr>
						<td>Computer <?php echo $count; ?></td>
						<td></td>
						<td></td>
						<td></td>					
					</tr>
				  <?php if ($count == 50) { break; } } //end for ?>
			</table>
			</div><!--leftTable-->
			<?php if($data['computer_count'] > 50) { 
			
			?>
			<div id="rightTable" style="width:400px;position:absolute;right:70px;">
			<table class="systemTable">
				<th>Computer #</th>
				<th>Time-In</th>
				<th>Current Time</th>
				<th>Status</th>		
				<?php 
				  for($count2=51;$count2<=$data['computer_count'];$count2++){ 
				 ?>
					<tr>
						<td>Computer <?php echo $count2; ?></td>
						<td></td>
						<td></td>
						<td></td>					
					</tr>
				  <?php } //end for ?>
			</table>
			<?php } ?>
			</div><!--rightTable-->

@stop