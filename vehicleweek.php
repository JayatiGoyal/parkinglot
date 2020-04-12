<?php
	session_start();
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'parking_lot');
	date_default_timezone_set('Asia/Kolkata');
	$i_q="SELECT * FROM NUMBER_OF_VEHICLES WHERE DATE <= '2020-04-12' AND DATE >= DATE_SUB('2020-04-12', INTERVAL 7 DAY)";
	$i_res=mysqli_query($con,$i_q);
	$num = mysqli_num_rows($i_res);
	$count=0;
	while($last=mysqli_fetch_row($i_res))
    {
       	$count=$count+$last[1];
    }
    echo $count;
	mysqli_close($con);
?>