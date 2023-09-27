<?php
include 'db.php';
session_start();
$riderid = $_GET["rider_id"];

if(isset($_POST['update_account']))
{
  $riderid=$_POST['uid'];
  $name=$_POST['uname'];
  $phone=$_POST['uphone'];
  $password=$_POST['upassword'];
  
  $uprider=mysqli_query($conn,"UPDATE riders SET name='$name',phone='$phone',txtaddress='$address', password='$password' WHERE  rider_id=$riderid");
	

if($uprider)
    {
    	echo '<h1>Successfully updated the account!</h1>';  
    	echo "<script> location.href='account_management.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo '<h1>Error!</h1>'; 
    }
}
$query = mysqli_query($conn, "SELECT * FROM riders WHERE rider_id=$riderid");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$riderid=$row['rider_id'];
			$name=$row['name'];
			$phone=$row['phone'];
			$password=$row['password'];  
			global $riderid, $profilepic, $name, $lname, $phone, $password;
?>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <fieldset class="edit-acc-form" style="background-color: lightgrey;">
      <legend>Edit Account Information</legend>
      <form action="edit_rider_account.php" method="post">
    <center>
    <input type="hidden" id="uid" name="uid" value="  <?php $guid = $GLOBALS['riderid'];
  echo $guid;
  ?>">
  Name: <br><input type="text" id="uname" name="uname" value="  <?php $gupfn = $GLOBALS['name'];
  echo $gupfn;
  ?>"><br>
  Phone: <br><input type="text" id="uphone" name="uphone" value="  <?php $gupp = $GLOBALS['phone'];
  echo $gupp;
  ?>"><br>
  Password: <br><input type="password" id="upassword" name="upassword" value="  <?php $guppw = $GLOBALS['password'];
  echo $guppw;
  ?>"><br>
  <input type="submit" name="update_account" class="btn-update" value="Update Account" style="font-size: 20px;">
  </center>
  </form>
  <?php }  }  ?>
  </fieldset>
  </body>
</html>