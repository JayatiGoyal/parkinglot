<?php
	session_start();
	//check the validity of registration number entered
	function check_number($veh_id){
		$states=array("AP","AR","AS","BR","CG","GA","GJ","HR","HP","JK","JH","KA","KL","MP","MH","MN","ML","MZ","NL","OR","PB","RJ","SK","TN","TR","UK","UP","WB","TR","AN","CH","DH","DD","DL","LD","PY");
		$temp=$veh_id[0].$veh_id[1];
		$flag=0;
		foreach($states as $state){
			if($state==$temp){
				$flag=1;
				break;
			}
	}}

	function getPrice($time){
		$time=$time/60;
		if($time<3)
			return 50;
		else if($time<4)
			return 60;
		else 
			return 80;
	}

	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'parking lot');
	date_default_timezone_set('Asia/Kolkata');						//To get the time

	if(isset($_POST['veh_id'])){
		$i_veh_id=$_POST['veh_id'];
	}
	else{
		$i_veh_id = "Vehicle Id not set in POST Method";
	}

	$i_q1="SELECT * FROM VEHICLE WHERE VEHICLE_ID='$i_veh_id'" ;		

	$i_res1=mysqli_query($con,$i_q1);

	$temp=mysqli_num_rows($i_res1);

	if($temp==0){													//If the vehicle is not found in the db
		echo '<script language="javascript">';
		echo 'alert("VEHICLE DOES NOT EXIST!");
		window.location.href="http://localhost/PL/delete.html"';
		echo '</script>';
		mysqli_close($con);
	}
	else{
		$i_row=mysqli_fetch_row($i_res1);
		$i_slot= $i_row[3];												//Save the slot for changes in the slot table
		$i_time=strtotime(date('d-m-Y H:i:s'))-strtotime($i_row[2]);	//Time difference
	}

	$i_q2="DELETE FROM VEHICLE WHERE VEHICLE_ID='$i_veh_id'";

	$i_res2=mysqli_query($con,$i_q2);

	$i_q3="DELETE FROM OWNER WHERE VEHICLE_ID_='$i_veh_id'";			//Remove from owner table

	$i_res3=mysqli_query($con,$i_q3);

	$i_q4="update SLOT SET STATUS=0x00 where SLOT_ID_='$i_slot'";		//Update the slot to 0

	$i_res4=mysqli_query($con,$i_q4);

	$price=getPrice($i_time);

	if ($i_res4) {
	$time=gmdate($i_time);
		/*echo '<script language="javascript">';
		echo 'alert("VEHICLE REMOVED SUCCESSFULLY!!");
		window.location.href="http://localhost/PL/after-login.html"';
		echo '</script>';
		mysqli_close($con);*/
		require_once '/home/vibhanshi/vendor/autoload.php';
	session_start();
	$mpdf = new \Mpdf\Mpdf(['format' => [150, 220]]);
	$bo=3;
	$time="H:i:s";
	$align="center";
	$data="";
	$data.="
	<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
	body{
				text-align: center;
				border-style: solid;
				border-width: 5px;
				border-radius: 15px;
				background: #fff;
				width: 500PX;
				margin: auto;
			}

			h1{
				text-decoration: underline;
			}

}
</style>
</head>
<body>
		<h1>TICKET</h1>

		<h2>SLOT NO.</h2>
		<p> $i_slot </p>

		<table border=$bo align=$align>

			<tr>
				<th>Duration</th>
				<td>$i_time</td>
			</tr>

			<tr>
				<th>Vehicle no</th>
				<td>$i_veh_id</td>
			</tr>

		</table>
		<br>
		<h2> YOUR FARE : Rs.$price </h2>
		<br>
	<h3>PARKING CHARGES</h3>
		<table border=$bo align=$align>

			<tr>
				<td>0-3 hours</td>
				<td>₹50</td>
			</tr>

			<tr>
				<td>3-4 hours</td>
				<td>₹60</td>
			</tr>

			<tr>
				<td>4+ hours</td>
				<td>₹80</td>
			</tr>
		</table>
		<br>
		<div>
		<h2>THANK YOU! </h2>
		<br>
		<h2>VISIT AGAIN</h2>
			
		</div>

	</body>
);";
 $mpdf->WriteHTML($data);
	$mpdf->Output('myfile.pdf','D');
}

	
?>




  
