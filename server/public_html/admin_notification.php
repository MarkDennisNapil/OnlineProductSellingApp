<?php
include 'db.php';
$today=date("Y/m/d");



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
    <div style="width:100%;background-color:whitesmoke;">
  		<div class="nav-area" style="height:100%;width:250px;left:0;top:0;position:fixed;z-index:1;background-color: teal;" id="mySidebar">
  <button class="nav-close" style="color:white;width:100%;background-color: orange;border:0px;text-align:right;"
  onclick="nav_close()">&times;</button><br>
  <a href="adminpage.php" class="nav-option"><img src="thumbnails/sales.png" width="25" height="25">Sales Report</a><br>
  <a href="admin_notification.php" class="nav-option"><img src="thumbnails/notification.png" width="25" height="25">Notification</a><br>
  <a href="product_management.php" class="nav-option"><img src="thumbnails/product.png" width="25" height="25">Product Management</a><br>
  <a href="account_management.php" class="nav-option"><img src="thumbnails/account.png" width="25" height="25">Account Management</a><br>
  <a href="orders.php" class="nav-option"><img src="thumbnails/orders.png" width="25" height="25">Customer Orders</a><br>
  <a href="deliver.php" class="nav-option"><img src="thumbnails/delivering.png" width="25" height="25">On Delivery</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25"></a>


</div>

<div class="main" style="margin-right:200px;background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
</div>

</div>
        <h3>Today</h3>
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM notifications WHERE reciever='admin' AND date='$today' ORDER BY notif_id DESC");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$sender=$row['sender'];
			$description=$row['description'];
			$message=$row['message'];
			$time=$row['time'];
		
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
        $query = mysqli_query($conn, "SELECT * FROM notifications WHERE reciever='admin' ORDER BY notif_id DESC");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$sender=$row['sender'];
			$description=$row['description'];
			$message=$row['message'];
			$time=$row['time'];
			$date=$row['date'];
		
        ?>
        <table class="tab-notif" style="width:98%;margin:auto;border:1px solid black;padding:5px;margin-bottom:7px;background-color:whitesmoke;">
          <tr>
            <td><h4 style="color: red;"><?php echo $description; ?></h4></td>
            </tr>
          <tr><td><?php echo $message; ?></td></tr>
          <tr><td style="color:blue;"><?php echo $time." | ".$date; ?></td></tr>
        </table>
        <?php } 
  
}  else{
echo "<h1>No notification!</h1>";
}?> 
    </div>
    <script src="js/script.js"></script>
  </body>
</html>