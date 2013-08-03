<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BlutzBytes</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="topPan"><a href="index.html"><img src="images/logo.gif" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0"/></a>
	<ul><!--Navigation Top-->
		<li><span>Home</span></li>
		<li><a href="#">About us</a></li>
		<li><a href="#">Services</a></li>
		<li><a href="#">Client</a></li>
		<li><a href="#">Contact</a></li>
	</ul>
</div>

<div id="bodyPan" style="margin-top:20px;width:1200px">
  <div id="leftPan" style="width:270px">
    	<div id="ourblog">
			<h2>System</h2>
			<p>Desktop publishing</p>
			<a href="#">&nbsp;</a>
		</div>
        <div id="possib">
			<h2>Reports</h2>
			<p>Desktop publishing</p>
			<a href="#">&nbsp;</a>
		</div>
		<div id="solution">
			<h2>Settings</h2>
			<p>Desktop publishing</p>
			<a href="#">&nbsp;</a>
		</div><!--leftPan-->
  </div><!--bodyPan-->
  <div id="rightPan" style="right:0;width:920px;height:1300px;background:none;">
  	<div id="rightbodyPan" style="width:900px;height:auto;" >
		<!--CONTENT HERE-->
			@yield('content')
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
		
		
		<!--CONTENT END-->
	
  	</div><!--rightbodyPan-->
  </div><!--rightPan-->
</div><!--bodyPan-->
<!--FOOTER COMMENT
<div id="footerPan">
	<div id="footernextPan">
	<ul>
  <li><a href="#">Home </a>| </li>
  <li><a href="#">About us</a> | </li>
  <li><a href="#">Support </a>| </li>
  <li><a href="#">Clients</a> | </li>
  <li><a href="#">Contact </a> </li>
  </ul>
   <p>©green solution all right reaserved</p>
    <ul class="templateworld">
  	<li>Design By:</li>
	<li><a href="http://www.templateworld.com" target="_blank">Template World</a></li>
  </ul>
   <div id="footerPanhtml"><a href="http://validator.w3.org/check?uri=referer" target="_blank">XHTML</a></div>
   <div id="footerPancss"><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">CSS</a></div>
	</div>
</div>
-->
</body>
</html>
