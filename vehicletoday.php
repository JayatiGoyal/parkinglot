<?php
	session_start();
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'parking_lot');
	date_default_timezone_set('Asia/Kolkata');
	$i_q="SELECT * FROM NUMBER_OF_VEHICLES WHERE DATE = '2020-04-12'";
	$i_res=mysqli_query($con,$i_q);
	$i_row=mysqli_fetch_row($i_res);
	//echo $i_row[1];
	echo '<script language="javascript">';
	echo 'alert($i_row[1]);
		window.location.href="http://localhost/parkinglot/home.html"';
	echo '</script>';
	mysqli_close($con);
	
?>