<?php

session_start();

function check_number($veh_id){
$states=array("AP","AR","AS","BR","CG","GA","GJ","HR","HP","JK","JH","KA","KL","MP","MH","MN","ML","MZ","NL","OR","PB","RJ","SK","TN","TR","UK","UP","WB","TR","AN","CH","DH","DD","DL","LD","PY");
$temp=$veh_id[0].$veh_id[1];
$flag=0;
foreach($states as $state){
	if($state==$temp){
		$flag=1;
		break;}
}
if($flag==1 && is_numeric($veh_id[2]) && is_numeric($veh_id[3]))
	return 1;
else 
	return 0;
} 
	

$con=mysqli_connect('localhost','root');

if(!$con)
{
	echo "Connection failed";
}

mysqli_select_db($con,'parking lot');

date_default_timezone_set('Asia/Kolkata');

$i_veh_id=$_POST['veh_id'];
$i_type=$_POST['type'];
$i_time=date('d-m-Y H:i:s');
$i_name=$_POST['owner'];
$i_phone=$_POST['phone_no'];

$i_q1="SELECT * FROM SLOT WHERE STATUS=0x00 AND DIMENSION='$i_type'" ;

$i_res1=mysqli_query($con,$i_q1);

$temp=mysqli_num_rows($i_res1);

if($temp==0){
		echo '<script language="javascript">';
		echo 'alert("PARKING LOT FULL!");
		window.location.href="http://localhost/PL/insert.html"';
		echo '</script>';
}

else
{
	$i_row=mysqli_fetch_row($i_res1);
	$i_slot= $i_row[0];
}	

if(check_number($i_veh_id)==0){

		echo '<script language="javascript">';
		echo 'alert("INVALID VEHICLE NUMBER!");
		window.location.href="http://localhost/PL/insert.html"';
		echo '</script>';
		mysqli_close($con);
}
	

$i_q2="INSERT INTO VEHICLE(VEHICLE_ID, TYPE, ENTRY_TIME,SLOT_ID) VALUES ('$i_veh_id', '$i_type',NOW(), '$i_slot')";

$i_res2=mysqli_query($con,$i_q2);

if (!$i_res2) {
		echo '<script language="javascript">';
		echo 'alert("VEHICLE ALREADY EXISTS!");
		window.location.href="http://localhost/PL/insert.html"';
		echo '</script>';
		mysqli_close($con);
}

$i_q3="INSERT INTO OWNER(VEHICLE_ID_, NAME, PHONE_NUMBER) VALUES ('$i_veh_id', '$i_name', '$i_phone')";

$i_res3=mysqli_query($con,$i_q3);

if (!$i_res1) {
    echo "Error " . mysqli_error($con);
}

$i_q4="update SLOT SET STATUS=0x01 where SLOT_ID_='$i_slot'";

$i_res4=mysqli_query($con,$i_q4);

if ($i_res4) {
		//echo '<script language="javascript">';
		//echo 'alert("VEHICLE INSERTED SUCCESSFULLY!!");
		//window.location.href="http://localhost/PL/pdf.php"';
		//echo '</script>';
		//mysqli_close($con);
    //echo "Error " . mysqli_error($con);
   require_once '/home/vibhanshi/vendor/autoload.php';
	session_start();
	$mpdf = new \Mpdf\Mpdf(['format' => [150, 220]]);
	$bo=3;
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
				<th>Customer name</th>
				<td>$i_name</td>
			</tr>
			
			<tr>
				<th>Phone Number</th>
				<td>$i_phone</td>
			</tr>

			<tr>
				<th>Arrival time.</th>
				<td>$i_time</td>
			</tr>

			<tr>
				<th>Vehicle no</th>
				<td>$i_veh_id</td>
			</tr>

			<tr>
				<th>Vehicle type</th>
				<td>$i_type</td>
			</tr>

		</table>
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
		<h1>INSTRUCTIONS</h1>
			<p>1. Losing the parking ticket is chargeable with ₹350 fine. <br>
		   2. Overnight parking is not allowed and the vehicle will be towed to the police station. <br>3. Parking must be done in only the alloted slot. <br>
		</p>
		</div>

	</body>
);";
 $mpdf->WriteHTML($data);
	$mpdf->Output('myfile.pdf','D');
}

?>
