<?php

session_start();

$con=mysqli_connect('localhost','root');

	/*if($con)
		{
			echo "Connection Successful";
		}
	else
		{
			echo "Connection couldn't be established";
		}
	*/
	mysqli_select_db($con,'parking_lot');
	
   if(isset($_POST['username'])){
      $name = $_POST['username']; 
 }else{
      $name = "Name not set in POST Method";
 }
	$pass = $_POST['password'];
	//echo $name;
	//echo $pass;
	//$name = $_POST['username'];
	$q = "select * from LOGIN where username ='$name' && password ='$pass' ";
	
	$result = mysqli_query($con,$q);
	
	$num = mysqli_num_rows($result);
	//echo $num;

	if($num==1)
	{
		$_SESSION['username']=$name;
		header('location:http://localhost/parkinglot/after-login.html');
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Wrong username password!");
		window.location.href="http://localhost/parkinglot/login.html"';
		echo '</script>';
	}
	
		
?>
