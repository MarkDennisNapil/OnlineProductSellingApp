<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];
$today=date("Y/m/d");

$prof = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");
    if(mysqli_num_rows($prof) > 0){
			while($row=mysqli_fetch_array($prof)){
				$profilepic=$row['profilepic'];
				$email=$row['email'];
				global $profilepic;
			}
    }else{
      
    }


?>
<!DOCTYPE html>
<html>
  <head>
	   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
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

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
    <div class="form-notification" style="padding:7px;">
        <h3>Today</h3>
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM notifications WHERE reciever_id=$userid AND date='$today' ORDER BY notif_id DESC");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$sender=$row['sender'];
			$description=$row['description'];
			$message=$row['message'];
			$time=$row['time'];
			$date=$row['date'];
		
        ?>
        <table class="tab-notif" style="width:100%;border:1px solid black;padding:5px;margin-bottom:7px;">
          <tr>
            <td><h4 style="color: red;"><?php echo $description; ?></h4></td>
            </tr>
          <tr><td><?php echo $message; ?></td></tr>
          <tr><td style="color:blue;"><?php echo $time; ?></td></tr>
        </table>
        <?php } 
}  else{
echo "<h1>No notification!</h1>";
}?> 

      

          <h3>All</h3> 
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM notifications WHERE reciever_id=$userid ORDER BY notif_id DESC");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$sender=$row['sender'];
			$description=$row['description'];
			$message=$row['message'];
			$time=$row['time'];
			$date=$row['date'];
		
        ?>
      <table class="tab-notif" style="width:100%;border:1px solid black;padding:5px;margin-bottom:7px;">
        <tr><td><h4 style="color: red;"><?php echo $description; ?></h4></td></tr>
        <tr><td><?php echo $message; ?></td></tr>
        <tr><td style="color:blue;"><?php echo $time."|".$date; ?></td></tr>
      </table>
        <?php } 
}  else{
echo "<h1>No notification!</h1>";
}?> 

    </div>
    <script src="js/script.js"></script>
  </body>
</html>