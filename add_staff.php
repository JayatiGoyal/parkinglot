<?php

session_start();

$con=mysqli_connect('localhost','root');

if(!$con)
{
	echo "Connection failed";
}

mysqli_select_db($con,'parking lot');

$fn=$_POST['First_name'];
$ln=$_POST['Last_name'];
$mob=$_POST['phone_no'];
$gender=$_POST['gender'];
$role=$_POST['role'];
$sal=$_POST['salary'];
$adr=$_POST['address'];

$q0="select * from STAFF ORDER BY STAFF_ID DESC";
$res0=mysqli_query($con,$q0);

$staff_id=mysqli_fetch_row($res0);
$temp=$staff_id[0];
$sid=intval($temp[7].$temp[8].$temp[9])+1;
$std="1RV17IS0";
$id=$std.strval($sid);

$q="INSERT INTO STAFF(STAFF_ID,First_Name,Last_Name,Phone_no,Gender,ROLE,SALARY,ADDRESS) VALUES ('$id','$fn','$ln','$mob','$gender','$role','$sal','$adr')";

$res1=mysqli_query($con,$q);

header('location:after-login.html');

if(!$res1)
echo mysqli_error($con);


