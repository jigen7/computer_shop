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

		   clearFields();

		   $("#timeoutID").val(id);
		   $('#compute').trigger('click');
          $( "#dialog-confirm-timeout" ).dialog({
               resizable: false,
               height:360,
			   width:360,
               modal: true,
               buttons: {
                 "Proceed": function() {

		               var hiddenTotalPrice = $("#hiddenTotalPrice").val();
   	           		   var diff_min = $("#diff_min").val();
                       var diff_total = $("#diff_total").val();
		               var	diff_override = $("#diff_override").val();
					   
					   var hiddenNow = $("#hiddenNow").val();
		               var hiddenTimein = $('#hiddenTimein').val();
		               var hiddenCurrentTime = $("#hiddenCurrentTime").val();
				 	   var params = "?hiddenNow="+hiddenNow+"&hiddenTimein="+hiddenTimein+"&hiddenCurrentTime="+hiddenCurrentTime+"&hiddenTotalPrice="+hiddenTotalPrice+"&diff_min="+diff_min+"&diff_total="+diff_total+"&diff_override="+diff_override;;

                    window.location.href = url+params;
					  //$("#formTimeout").submit();
                  },
                 Cancel: function() {
                 $( this ).dialog( "close" );
				 clearFields();
                  }
              }
          });//end of dialog-confirm
		  	     $( "#dialog-confirm-timeout" ).dialog( "option", "title", "Time-out Computer "+id+" ?" );
                 $('#dialog-confirm-timeout').dialog("open");
				 
		});//end of btnTimeout
		
		$( "#compute" ).click(function() {
				id = $("#timeoutID").val();
                deductMins = $("#diff_min").val();
                deductTotal = $("#diff_total").val();
				deductOverride = $("#diff_override").val();

                $.get("http://localhost/blutzbytes/public/system/computeinitial/comp_id/"+id+"?deductMins="+deductMins+"&deductTotal="+deductTotal+"&deductOverride="+deductOverride, function(data) {
                       //alert("Data Loaded: " + data.time_in);
					   //alert("Data Loaded: " + data.computed);
					   $('#tdTimein').empty().append("<b>"+data.time_in+"</b>");
					   $('#tdCurrentTime').empty().append("<b>"+data.current+"</b>");
					   $('#tdComputed').empty().append("<b>"+data.computed+"</b>");
					   $("#totalPrice").val(data.computedTotalFinal);
					   
					   //Set to Hidden
					    $("#hiddenNow").val(data.now);
					    $('#hiddenTimein').val(data.time_in);
						$("#hiddenCurrentTime").val(data.current);
						$("#hiddenTotalPrice").val(data.computedTotalFinal);
						
                 });
				
		});//end of btnTimeout
		
		$('#diff_min').focusout(function() {
				$('#compute').trigger('click');
		});
		
        $('#diff_total').focusout(function() {
				$('#compute').trigger('click');
		});
		
		$('#diff_override').focusout(function() {
				$('#compute').trigger('click');
		});
		
		$('#diff_min').keyup(function() {
				this.value = this.value.replace(/[^0-9\.]/g,'');
				//$('#compute').trigger('click');
		});
		
        $('#diff_total').keyup(function() {
				this.value = this.value.replace(/[^0-9\.]/g,'');
				//$('#compute').trigger('click');
		});
		
		$('#diff_override').keyup(function() {
				
				this.value = this.value.replace(/[^0-9\.]/g,'');
				$('#compute').trigger('click');
		});
		
		
		
		
		function clearFields(){
		        $('#tdTimein').empty();
 			    $('#tdCurrentTime').empty();
			    $('#tdComputed').empty();
				$("#diff_min").empty();
			    $("#diff_total").empty();
                $("#diff_min").val("");
                $("#diff_total").val("");
				$("#diff_override").val("");
				$("#totalPrice").val("");
		} //clearFields
		
		/*
		//alert($("#timedisplay10").text());
		var open_computer_nos = <?php echo json_encode($data['open_computer_nos']); ?>;
		//alert(open_computer_nos.length);
		
		if(open_computer_nos.length > 0){
			open_computer_nos.forEach(function(entry) {
				//console.log(entry);
				//alert(entry);
				timeCurr = $("#timedisplay"+entry).text();
				txtTimeCurr = "#timedisplay"+entry;
				timeStamp = new Date();
				timeStamp.setHours(timeCurr.split(':')[0],timeCurr.split(':')[1],timeCurr.split(':')[2]);
				//timeStampFinal = timeStamp.getHours()+":"+timeStamp.getMinutes()+":"+timeStamp.getSeconds();
				//window.setInterval("updateTime("+timeStampFinal+",#timedisplay"+entry+")", 1000);
				//window.setInterval("updateTime(#timedisplay"+entry+")", 1000);
				window.setInterval(function() { 
					updateTime(timeStamp,txtTimeCurr);
					}
				,1000);
			}); //end for each
		
		}//end if 
        */
		/*
				var test = "09:54:58 ";
		alert(test.split(':')[1]);
		alert 
		var id = this.id.split('_')[1];
		setHours(15,35,1)
		        function initTime() {
            time0 = new Date();
            window.setInterval("updateTime()", 1000);
			 var d3 = new Date(0,0,0,11,33,0);
			alert(d3);
        }
		*/
        function updateTime(time0,elementID) {
			/*
            var timeNow = new Date();
            var deltas = (Number(timeNow) - Number(time0))/1000;
            var deltah = ("0"+String(Math.round(deltas / 3600))).substr(-2);
            deltah = deltah.substr(-2);
            deltas %= 3600;
            var deltam = ("0"+String(Math.round(deltas / 60))).substr(-2);
            deltas = ("0"+String(Math.round(deltas % 60))).substr(-2);
            document.getElementById("timedisplay").firstChild.data=deltah+":"+deltam+":"+deltas;
			*/
			alert(time0+" :: "+elementID);
        }

		
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
			
			<div id="dialog-confirm-timeout" style="display:none;">
				<table>
					<tr>
						<td>Time-In Time : </td>
						<td id="tdTimein"> </td>
					</tr>
					<tr>
						<td>Current Time Spent : </td>
						<td  id="tdCurrentTime"> </td>
					</tr>
					<tr>
						<td>Computed Total : P</td>
						<td id="tdComputed"> </td>
					</tr>				
				</table>
				 <form class="clear" style="margin-top:15px" method="PUT" action="" id="formTimeout" name="formTimeout">
						<table>
						<tr>
						       <td><label for="name">Deduct Minutes : </label> </td>
                               <td> &nbsp;&nbsp; <input type="text" name="diff_min" id="diff_min" class="text ui-widget-content ui-corner-all" style="width:50px;" /></td>
					    </tr>
						<tr>
						       <td><label for="name">Deduct Total :</label></td> 
                               <td> P <input type="text" name="diff_total" id="diff_total" class="text ui-widget-content ui-corner-all" style="width:50px;" /></td>
					     </tr>
						 <tr>
						       <td><label for="name">Override Total :</label></td> 
                               <td> P <input type="text" name="diff_override" id="diff_override" class="text ui-widget-content ui-corner-all" style="width:50px;" /></td>
					     </tr>
						 </table>
						 <input type ="hidden" id="timeoutID" name="timeoutID">
						 <input type ="hidden" id="hiddenNow" name="hiddenNow" >
						  <input type ="hidden" id="hiddenTimein" name="hiddenTimein">
						   <input type ="hidden" id="hiddenCurrentTime" name="hiddenCurrentTime">
						   <input type ="hidden" id="hiddenTotalPrice" name="hiddenTotalPrice">
                  
						<div style="font-weight:strong;margin-top:6px;">
						<input type="button" value="Compute" style="float:left" id="compute" name="compute">&nbsp;
						<b>OverAll Total : P</b> 
							  <input type="text" name="totalPrice" id="totalPrice" class="text ui-widget-content ui-corner-all" style="width:70px;" readonly="readonly">
					     </div>
						 </form>
		         <!-- <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Are you sure?</p> -->
            </div>
@stop