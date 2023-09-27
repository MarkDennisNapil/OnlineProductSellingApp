<?php
include 'db.php';
session_start();
$userid = $_GET["id"];

if(isset($_POST['update_account']))
{
  $userid=$_POST['uid'];
  $fname=$_POST['ufname'];
  $lname=$_POST['ulname'];
  $phone=$_POST['uphone'];
  $address=$_POST['uaddress'];
  $password=$_POST['upassword'];
  
  $upuser=mysqli_query($conn,"UPDATE users SET fname='$fname',lname='$lname',phone='$phone',txtaddress='$address', password='$password' WHERE  id=$userid");
	

if($upuser)
    {
    	echo '<h1>Successfully updated the account!</h1>';  
    	echo "<script> location.href='profile.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo '<h1>Error!</h1>'; 
    }
}
$query = mysqli_query($conn, "SELECT * FROM users WHERE id=$userid");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$userid=$row['id'];
			$fname=$row['fname'];
		  $lname=$row['lname'];
			$phone=$row['phone'];
			$txtaddress=$row['txtaddress'];
			$password=$row['password'];  
			global $userid, $profilepic, $fname, $lname, $phone, $txtaddress, $password;
?>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      body{
        font-size: 25pt;
      }
      input{
        font-size: 25pt;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div style="width:98%;margin:auto;background-color:whitesmoke;">
      <h3 style="font-size:30pt;">Edit Account Information</h3>
      <form action="edit_account.php" method="post">
    <input type="hidden" id="uid" name="uid" value="  <?php $guid = $GLOBALS['userid'];
  echo $guid;
  ?>">
  First Name: <br><input type="text" id="ufname" name="ufname" value="  <?php $gupfn = $GLOBALS['fname'];
  echo $gupfn;
  ?>"><br>
  Last Name: <br><input type="text" id="ulname" name="ulname" value="  <?php $gupln = $GLOBALS['lname'];
  echo $gupln;
  ?>"><br>
  Phone: <br><input type="text" id="uphone" name="uphone" value="  <?php $gupp = $GLOBALS['phone'];
  echo $gupp;
  ?>"><br>
  Address: <br><input type="text" id="uaddress" name="uaddress" value="  <?php $gupadd = $GLOBALS['txtaddress'];
  echo $gupadd;
  ?>"><br>
  Password: <br><input type="password" id="upassword" name="upassword" value="  <?php $guppw = $GLOBALS['password'];
  echo $guppw;
  ?>"><br>
  <input type="submit" name="update_account" class="btn-update" value="Update Account" style="font-size: 25pt;">
  </form>
  <?php }  }  ?>
  </div>
  </body>
</html>