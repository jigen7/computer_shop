@extends('layout')

@section('content')
<script>
	$(document).ready(function() {
		
		$( ".btnTimein" ).click(function() {
           var id = this.id.split('_')[1];
		   var url = 'http://localhost/blutzbytes/public/system/timein/comp_id/'+id;
          $( "#dialog-confirm" ).dialog({
               resizable: false,
               height:140,
               modal: true,
               buttons: {
                 "Proceed": function() {
                    window.location.href = url;
                  },
                 Cancel: function() {
                 $( this ).dialog( "close" );
                  }
              }
          });//end of dialog-confirm
		  	     $( "#dialog-confirm" ).dialog( "option", "title", "Time-In Computer "+id+" ?" );
                 $('#dialog-confirm').dialog("open");
		});//end of btnTimein
		
		$( ".btnTimeout" ).click(function() {
		   var id = this.id.split('_')[1];
		   var url = 'http://localhost/blutzbytes/public/system/timeout/comp_id/'+id;
          $( "#dialog-confirm-timeout" ).dialog({
               resizable: false,
               height:300,
			   width:300,
               modal: true,
               buttons: {
                 "Proceed": function() {
                    window.location.href = url;
                  },
                 Cancel: function() {
                 $( this ).dialog( "close" );
                  }
              }
          });//end of dialog-confirm
		  	     $( "#dialog-confirm-timeout" ).dialog( "option", "title", "Time-out Computer "+id+" ?" );
                 $('#dialog-confirm-timeout').dialog("open");
		});//end of btnTimeout
		
		
	});//document ready
	



</script>

<div id="leftTable" style="width:400px;position:absolute;left:0;">
			<table class="systemTable">
				<th>Computer #</th>
				<th>Time-In</th>
				<th>Current Time</th>
				<th>Status</th>		
				<?php 
				  for($count=1;$count<=$data['computer_count'];$count++){ 
				    if($count != $data['computer_status'][$count]['id']){ throw new Exception ("Computer Number Mismatch"); }; 
				 ?>
					<tr>
						<td>Computer <?php echo $count; ?></td>
							 <?php if ( $data['computer_status'][$count]['status'] == "open") { $fontColor = "fontGreen"; ?>
								<td><input type="button" value="Time In" class="btnTimein" id="comp_<?php echo $count; ?>"></td>
							 <?php } else { $fontColor = "fontRed";?>
								<td>{{ $data['computer_status'][$count]['time_in']}}</td>						 
							 <?php } ?>						
						<td>{{ $data['computer_status'][$count]['current_time']}} 
						    <?php if($data['computer_status'][$count]['is_close'] == 1) { ?> 
							<a href="javascript:void(0);" class="btnTimeout" id="comp-timeout_<?php echo $count; ?>"><img src="<?php echo asset('images/timeout16.png')?>"> </a>
						     <?php } ?>
						</td>
							<td class="<?php echo $fontColor ?>">{{ strtoupper($data['computer_status'][$count]['status']) }}</td>					
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
				  for($count=51;$count<=$data['computer_count'];$count++){ 
				  if($count != $data['computer_status'][$count]['id']){ throw new Exception ("Computer Number Mismatch"); }; 
				 ?>
					<tr>
						<td>Computer <?php echo $count; ?></td>
							 <?php if ( $data['computer_status'][$count]['status'] == "open") { $fontColor = "fontGreen"; ?>
								<td><input type="button" value="Time In" class="btnTimein" id="comp_<?php echo $count; ?>"></td>
							 <?php } else { $fontColor = "fontRed";?>
								<td>{{ $data['computer_status'][$count]['time_in']}}</td>						 
							 <?php } ?>						
						<td>{{ $data['computer_status'][$count]['current_time']}} 
						    <?php if($data['computer_status'][$count]['is_close'] == 1) { ?> 
							<a href="javascript:void(0);" class="btnTimeout" id="comp-timeout_<?php echo $count; ?>"><img src="<?php echo asset('images/timeout16.png')?>"> </a>
						     <?php } ?>
						</td>
							<td class="<?php echo $fontColor ?>">{{ strtoupper($data['computer_status'][$count]['status']) }}</td>					
					</tr>
				  <?php } //end for ?>
			</table>
			<?php } ?>
			</div><!--rightTable-->
			
            <div id="dialog-confirm" style="display:none">
                 <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Are you sure?</p>
            </div>
			
			<div id="dialog-confirm-timeout" style="display:none;" >
				<table>
					<tr>
						<td>Time - In Time : </td>
						<td>
					</tr>
					<tr>
						<td>Current Time Spent : </td>
						<td>
					</tr>
					<tr>
						<td>Computed Total : </td>
						<td>
					</tr>
				
				</table>
				
				
				
				 <form class="clear">
                    <fieldset>
                       <label for="name">Deduct Minutes : </label> 
                             <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" style="width:50px;" />
							 <br>
					   <label for="name">Deduct Total : </label> 
                             <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" style="width:50px;margin-left:20px;" />

                       </fieldset>
                  </form>
		          <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Are you sure?</p>
            </div>
			
			

@stop