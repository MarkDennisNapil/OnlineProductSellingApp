<?php
include 'db.php';
session_start();

if(isset($_POST['register']))
{
	 $filename = $_FILES["image"]["name"];
    $target_dir = 'uploads/'.$filename;
	$target_file = $target_dir . basename($_FILES['image']['name']);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$role=$_POST['role'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$sql=mysqli_query($conn,"INSERT INTO users (profilepic,fname,lname,role,phone,email,password) VALUES ('$target_file','$fname','$lname','$role','$phone','$email','$password')");
	

if($sql)
    {
    	echo "Successfully registered!";  
    	echo "<script> location.href='account_management.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo "<div><h1>Error!<h1>"; 
	echo "<h1>Email already used! Limit one account per email.<h1></div>";
    }
}

?>
<html>
<head>
<title>Online Product Selling System</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>
  input{
    font-size: 25pt;
    width: 100%;
    padding: 5px;
  }
</style>
</head>
<body>
<center>
  <legend style="font-size:30pt;font-weight:bold;">Delivery Rider Registration</legend>
<form action="add_del_ride.php" method="post" enctype="multipart/form-data">
	<table class="tab-register" style="font-size:25pt;background-color:whitesmoke;padding:7px;width:100%;">
	<tr>
	  <td><input type="hidden" name="role" value="rider"></td>
	</tr>
	<tr>
		<td>First Name:</td>
	</tr>
	<tr>
		<td><input type="text" name="fname" placeholder="First name..." required></td>
	</tr>
	<tr>
	    <td>Last Name:</td>
	</tr>
	<tr>
		<td><input type="text" name="lname" placeholder="Last name..." required></td>
	</tr>
		<tr>
		<td>Attach Profile Picture:</td>
		</tr>
		<tr>
		<td><input type="file" name="image" required></td>
	</tr>
	<tr>
		<td>Phone:</td>
	</tr>
	<tr>
		<td><input type="number" name="phone" placeholder="Phone here..." required></td>
	</tr>
	<tr>
		<td>Email Address:</td>
	</tr>
	<tr>
		<td><input type="email" name="email" placeholder="myemailname@email.com..." required></td>
	</tr>
	<tr>
		<td>Password:</td>
	</tr><tr>
		<td><input type="password" name="password" placeholder="Password..." required></td>
	</tr>
</table>
	<input type="submit" name="register" id="register" class="reg-link" style="font-size:25pt;font-weight:bold;width:100%;background-color:teal;padding:10px;border:0px;width:98%;" value="Register">
</form>
</center>
</body>
</html>