<?php
// We need to use sessions, so you should always start sessions using the below code.
include 'db.php';
session_start();

$userid=$_SESSION['id'];
// If the user is not logged in redirect to the login page...
if(!isset($userid)){
   header('location:login.php');
}

$getacc = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");
    if(mysqli_num_rows($getacc) > 0){
			while($row=mysqli_fetch_array($getacc)){
				$id=$row['id'];
				$profilepic=$row['profilepic'];
				$fname=$row['fname'];
				$lname=$row['lname'];
				$sex=$row['sex'];
				$phone=$row['phone'];
				$email=$row['email'];
				$bday=$row['bday'];
				$txtaddress=$row['txtaddress'];

?>

<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
<div class="nav-area" style="height:100%;width:200px;left:0;top:0;position:fixed;z-index:1;background-color: teal;" id="mySidebar">
  <button class="nav-close" style="color:white;width:100%;background-color: orange;border:0px;text-align:right;"
  onclick="nav_close()">&times;</button><br>
  <a href="index.php" class="nav-option"><img src="thumbnails/home.png" width="25" height="25">Home</a><br>
  <a href="mycart.php" class="nav-option"><img src="thumbnails/cart.png" width="25" height="25">My Cart</a><br>
  <a href="customer_to_recieve.php" class="nav-option"><img src="thumbnails/cart2.png" width="25" height="25">My Order Records</a><br>
  <a href="notification.php" class="nav-option"><img src="thumbnails/notification.png" width="25" height="25">Notifications</a><br>
  <a href="profile.php" class="nav-option"><img src="thumbnails/myprofile.png" width="25" height="25">My Profile</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25">Logout</a>


</div>

<div class="main" id="content" style="background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
  <a><img src="<?php $profpic = $GLOBALS['profilepic']; 
      echo $profpic; ?>" class="profile-pic"></a>
      <h1></h1>

</div>
</div>
				<table class="profile-tab" style="width:100%;">
				  <tr>
				    <td><img src="<?php echo $profilepic; ?>" id="profile-pic" style="width:100%;"></td>
				  </tr>
					<tr>
						<td>First Name: <?php echo $fname;?></td>
						</tr>
						<tr>
					  <td>Last Name: <?php echo $lname;?></td>
					</tr>
						<tr>
					  <td>Sex: <?php echo $sex;?></td>
					</tr>
					<tr>
						<td>Phone: <?php echo $phone;?></td>
					</tr>
					<tr>
						<td>Email: <?php echo $email;?></td>
					</tr>
						<tr>
						<td>Birthdate: <?php echo $bday;?></td>
					<tr>
						<td>Address: <?php echo $txtaddress;  }  }?></td>
					</tr>
	</table>
		<center><a href="edit_account.php?id=<?php echo $userid;?>" id="btnupdprofile" onclick="button_click()" style="background-color:teal;color:black;padding:5px;font-weight:bold;">Update Info</a><br>
		<p></p>
			<a href="upload_profilepic.php?id=<?php echo $userid;?>" id="btnupdprofilepic" style="background-color: teal;color:black;padding:5px;font-weight:bold;">Update Profile Picture</a>
			<p></p>
					</center>
			<script src="js/script.js"></script>
	</body>
</html>