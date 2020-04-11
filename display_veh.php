<!DOCTYPE html>
<html>
<head>
	<title>Parking lot</title>
	<link rel="stylesheet" href="home-style.css" type="text/css">
</head>
<body>
	<header>
		<div class="main">
		<ul>
				<li><a href="#">LOGOUT</a></li>
				<li><a href="after-login.html">BACK</a></li>
			</ul>
		
		</div>
		
<div style="width: 50%; float:left">
<br>
<br>
<h2> <font color="white">4 WHEELERS </h2>
<?php
session_start();
$con=mysqli_connect('localhost','root');

if(!$con)
{

	echo "Connection failed";
}
mysqli_select_db($con,'parking lot');

$q="select * from VEHICLE WHERE TYPE=4";

$res=mysqli_query($con,$q);
echo "<table>

<tr>

<th>VEHICLE_ID</th>
<th>TYPE</th>
<th>ENTRY_TIME</th>
<th>SLOT</th>
<th>OWNER</th>
<th>CONTACT</th>

</tr>";
while($row = mysqli_fetch_array($res))

  {
	$q2="select * from OWNER WHERE VEHICLE_ID_='$row[0]'";
  	$res2=mysqli_query($con,$q2);
  	$r4=mysqli_fetch_row($res2);
  echo "<tr>";

  echo "<td>" . $row['VEHICLE_ID'] . "</td>";

  echo "<td>" . $row['TYPE'] . "</td>";

  echo "<td>" . $row['ENTRY_TIME'] . "</td>";
  
  echo "<td>" . $row['SLOT_ID'] . "</td>";
  
  echo "<td>" . $r4[1] . "</td>";
  
  echo "<td>" . $r4[2] . "</td>";

  echo "</tr>";

  }

echo "</table>";
		
?>

</div>
<div style="width: 50%; float:right">
<br>
<br>
<h2><font color="white">2 WHEELERS </h2>
<?php
//session_start();
$con=mysqli_connect('localhost','root');

if(!$con)
{

	echo "Connection failed";
}
mysqli_select_db($con,'parking lot');

$q="select * from VEHICLE WHERE TYPE=2";

$res=mysqli_query($con,$q);
echo "<table>

<tr>

<th>VEHICLE_ID</th>
<th>TYPE</th>
<th>ENTRY_TIME</th>
<th>SLOT</th>
<th>OWNER</th>
<th>CONTACT</th>

</tr>";
while($row = mysqli_fetch_array($res))

  {
  	
  	$q1="select * from OWNER WHERE VEHICLE_ID_='$row[0]'";
  	$res1=mysqli_query($con,$q1);
  	$r=mysqli_fetch_row($res1);
  	

  echo "<tr>";

  echo "<td>" . $row['VEHICLE_ID'] . "</td>";

  echo "<td>" . $row['TYPE'] . "</td>";

  echo "<td>" . $row['ENTRY_TIME'] . "</td>";
  
  echo "<td>" . $row['SLOT_ID'] . "</td>";
  
  echo "<td>" . $r[1] . "</td>";
  
  echo "<td>" . $r[2] . "</td>";

  echo "</tr>";

  }

echo "</table>";
		
?>
</div></header>
</body></html>
