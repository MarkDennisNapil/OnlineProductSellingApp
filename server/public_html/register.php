<?php
include 'db.php';
session_start();

if(isset($_POST['register']))
{
	 $filename = $_FILES["image"]["name"];
    $target_dir = 'uploads/'.$filename;
	$target_file = $target_dir . basename($_FILES['image']["name"]);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$role=$_POST['role'];
	$sex=$_POST['sex'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$bday=$_POST['bday'];
	$txtaddresss=$_POST['txtaddress'];
	$password=$_POST['password'];
	
	$sql=mysqli_query($conn,"INSERT INTO users (profilepic,fname,lname,role,sex,phone,email,bday,txtaddress,password) VALUES ('$target_file','$fname','$lname','$role','$sex','$phone','$email','$bday','$txtaddresss','$password')");
	

if($sql)
    {

$to = $email;
$subject = "Welcome to Online Product Selling App!";
$txt = "You successfully registered. Shop high quality jersey product now!";
$headers = "From: onlineproductsellingapp@gmail.com";
mail($to,$subject,$txt,$headers);

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
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>
  input{
    font-size: 15pt;
    width: 100%;
    padding: 5px;
  }
  input[type=radio]{
    width:auto;
  }
</style>
</head>
<body>
  <center>
  <legend style="font-size:15pt;font-weight:bold;width:100%;">Customer registration</legend>
<form action="register.php" method="post" enctype="multipart/form-data">
	<table class="tab-register" style="font-size:15pt;background-color:whitesmoke;padding:7px;width:100%;">
	<tr>
	  <td><input type="hidden" name="role" value="customer" value="customer"></td>
	</tr>
	<tr> 
				<td>First Name:</td>
	</tr>
	<tr>
				<td><input type="text" name="fname" required=""></td>
			</tr>
	<tr>
		<td>Last Name:</td>
	</tr>
	<tr>
		<td><input type="text" name="lname"required=""></td>
	</tr>
		<tr>
		<td>Attach Profile Picture:</td>
  </tr>
  <tr>
		<td><input type="file" name="image" required></td>
	</tr>
	<tr>
		<td>Sex:</td>
	</tr>
	<tr>
		<td><label><input type="radio" name="sex" value="male">Male</label>
		<label><input type="radio" name="sex" value="female">Female</label></td>
	</tr>
	<tr>
		<td>Phone:</td>
	</tr>
	<tr>
		<td><input type="number" name="phone" required></td>
	</tr>
	<tr>
		<td>Email Address:</td>
	</tr>
	<tr>
		<td><input type="email" name="email" required></td>
	</tr>
	<tr>
		<td>Birthdate:</td>
	</tr>
	<tr>
		<td><input type="date" name="bday" placeholder="yyyy-mm-dd" required></td>
	</tr>
		<tr>
		<td>Address (Street, Barangay, Municipality, City):</td>
	</tr>
	<tr>
		<td><input type="text" name="txtaddress" required></td>
	</tr>
	<tr>
		<td>Password:</td>
	</tr>
	<tr>
		<td><input type="password" name="password" placeholder="Password..." required></td>
	</tr>
</table>
	<input type="submit" name="register" id="register" class="reg-link" style="font-size:25pt;font-weight:bold;background-color:teal;padding:10px;border:0px;width:98%;" value="Register">
</form>

</center>
</body>
</html>