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
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$sql=mysqli_query($conn,"INSERT INTO users (profilepic,fname,lname,phone,email,password) VALUES ('$target_file','$fname','$lname','$phone','$email','$password')");
	

if($sql)
    {
    	echo "Successfully registered!";  
    	echo "<script> location.href='reg_success.php'; </script>";
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
<link href="css/index.css" rel='stylesheet' type='text/css' />
</head>
<body>
<fieldset>
  <legend>Admin Registration</legend>
<form action="admin_register.php" method="post" enctype="multipart/form-data">
	<table>
	<tr> 
				<td>First Name:</td>
				<td><input type="text" name="fname" required=""></td>
			</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text" name="lname"required=""></td>
	</tr>
		<tr>
		<td>Attach Profile Picture:</td>
		<td><input type="file" name="image" required></td>
	</tr>
	<tr>
		<td>Phone:</td>
		<td><input type="number" name="phone" required></td>
	</tr>
	<tr>
		<td>Email Address:</td>
		<td><input type="email" name="email" required></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" placeholder="Password..." required></td>
	</tr>
</table>
	<input type="submit" name="register" id="register" class="reg-link" value="Register">
</form>
</fieldset>
</body>
</html>