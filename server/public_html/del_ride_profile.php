<?php
// We need to use sessions, so you should always start sessions using the below code.
include 'db.php';
session_start();

$riderid=$_SESSION['rider_id'];
// If the user is not logged in redirect to the login page...
if(!isset($riderid)){
   echo "<script> location.href='login.php'; </script>";
}

$getacc = mysqli_query($conn,"SELECT * FROM riders WHERE rider_id=$riderid");
    if(mysqli_num_rows($getacc) > 0){
			while($row=mysqli_fetch_array($getacc)){
				$profilepic=$row['profilepic'];
				$name=$row['name'];
				$email=$row['email'];
				$phone=$row['phone'];

?>

<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="css/index.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	  <div class="center">
        <img src="<?php echo $profilepic; ?>" id="profile-pic">
				<table class="profile-tab">
				  <tr>
				    <td colspan="2">Delivery Rider</td>
				  </tr>
					<tr>
						<td>Name:</td>
						<td><?php echo $name;?></td>
						</tr>
					<tr>
						<td>Email:</td>
						<td><?php echo $email;?></td>
					</tr>
					<tr>
					  <td>Phone:</td>
					  <td><?php echo $phone; ?></td>
					</tr>
					<tr>
					  <td><a href="up_rider_profilepic.php?rider_id=<?php echo $riderid;?>" class="btn-update" style="background-color:orange;float:right;">Update Profile Picture</a>	  </td>
					</tr>
				</table>
				<?php   }  }  ?>
			</div>
	   <a href="logout.php" class="btn-logout"style="padding: 12px; border-radius: 12px; color: white;">Logout</a>
	</body>
</html>