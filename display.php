<!DOCTYPE html>
<html>
<head>
	<title>Parking lot</title>
	<link rel="stylesheet" href="display.css" type="text/css">
</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
				<img src="logo1.jpg">
			</div>
			<ul>
				<li><a href="after-login.html">BACK</a></li>
				<li><a href="home.html">LOGOUT</a></li>
			</ul>
		</div>
<?php
session_start();
$con=mysqli_connect('localhost','root');

if(!$con)
{

	echo "Connection failed";
}
mysqli_select_db($con,'parking lot');

$q="select * from STAFF";

$res=mysqli_query($con,$q);

echo "<table>>

<tr>

<th>STAFF_ID</th>
<th>First_Name</th>
<th>Last_Name</th>
<th>Mobile</th>
<th>Gender</th>
<th>Role</th>
<th>Salary</th>
<th>Address</th>

</tr>";
while($row = mysqli_fetch_array($res))

  {

  echo "<tr>";

  echo "<td>" . $row['STAFF_ID'] . "</td>";

  echo "<td>" . $row['First_Name'] . "</td>";

  echo "<td>" . $row['Last_Name'] . "</td>";
  
  echo "<td>" . $row['Phone_no'] . "</td>";
  
  echo "<td>" . $row['Gender'] . "</td>";
  
  echo "<td>" . $row['ROLE'] . "</td>";
  
  echo "<td>" . $row['SALARY'] . "</td>";

  echo "<td>" . $row['ADDRESS'] . "</td>";

  echo "</tr>";

  }

echo "</table>";
			
?>
		</body>
		</html>

