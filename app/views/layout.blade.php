<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BlutzBytes</title>
{{ HTML::style('css/style.css'); }}
{{ HTML::script('js/jquery-1.10.2.min.js'); }}


<script>
	$(document).ready(function() {
     
         <?php if (Session::has('message')) { ?>
             alertMsg(); 
         <?php 	} ?>

        function alertMsg(){
        var message = "<?php echo Session::get('message'); ?>";
        alert(message);
        <?php Session::forget('message'); ?>
        }

	});
		
</script>
</head>

<body>
<div id="topPan"><a href="index.html"><img src="<?php echo asset('images/logo.gif')?>" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0"/></a>
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
			<p>TimeIn/TimeOut</p>
			<a href="#">&nbsp;</a>
		</div>
        <div id="possib">
			<h2>Reports</h2>
			<p>Daily,Weekly</p>
			<a href="#">&nbsp;</a>
		</div>
		<div id="solution">
			<h2>Settings</h2>
			<p>Configuration</p>
			<a href="#">&nbsp;</a>
		</div><!--leftPan-->
  </div><!--bodyPan-->
  <div id="rightPan" style="right:0;width:920px;height:1300px;background:none;">
  	<div id="rightbodyPan" style="width:900px;height:auto;" >
		<!--CONTENT HERE-->
			@yield('content')
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
