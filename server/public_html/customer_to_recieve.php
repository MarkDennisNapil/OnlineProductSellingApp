<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];
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
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style>
      button, a{
        border-radius: 3px;
      }
    </style>
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
    <a href="adminswitch.php" class="nav-option"><img src="thumbnails/profile.png" width="25" height="25">Switch to admin</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25">Logout</a>


</div>

<div class="main" style="margin-right:200px;background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;margin-bottom:5px;border-radius:0px;" onclick="nav_open()">&#9776;</button>
  <a><img src="<?php $profpic = $GLOBALS['profilepic']; 
      echo $profpic; ?>" class="profile-pic"></a>
</div>

</div>
<center>
  		<button id="btn-torecieve" onclick="show_torecieve()" style="padding: 7px;
  font-size: 15pt;background-color:white;">To recieve</button>
    		<button id="btn-myorderhistory" onclick="show_myorderhistory()" style="padding: 7px;
  font-size: 15pt;background-color:teal;">My order history</button>
</center>
  <div id="form-torecieve" style="padding:7px;">
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM orders WHERE customer_id=$userid AND order_status='delivering';");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$orderid=$row['order_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
		  $quantity=$row['quantity'];
			$worth=$row['worth'];
			$order_status=$row['order_status'];
			$product_id=$row['product_id'];
			?>
	 <table id="tab-torecieve" style="width:100%;border: 1px solid black;
  background-color: white; padding:7px;margin-bottom:5px;">
        <tr>
          <td><img src="<?php echo $product_image; ?>" width="160" height="160"></td>
        </tr>
        <tr>
          <td><?php echo "Order ID: ".$orderid;?></td>
        </tr>
        <tr>
          <td><?php echo "Product Name: ".$product_name;?></td>
        </tr>
        <tr>
          <td><?php echo "Quantity: ".$quantity;?></td>
        </tr>
        <tr>
          <td><?php echo "Worth: ".$worth;?></td>
        </tr>
        <tr>
          <td><?php echo "Order Status: ".$order_status;?></td>
        <tr>
          <td style="text-align:center;padding-top:5px;width:100%;"><a href="customer_order_recieved.php?order_id=<?php echo $orderid;?>" style="width: 100%;color:black;
  background-color: teal;
  padding: 7px;">Recieve</a></td>
        </tr>
    </table>
        <?php }  }  ?>
  </div>
  <div id="form-myorderhistory" style="padding:7px;">
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM orders WHERE customer_id=$userid AND order_status='paid' ORDER BY order_id DESC");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$orderid=$row['order_id'];
			$product_image=$row['product_image'];
	   	$product_name=$row['product_name'];
	   	$quantity=$row['quantity'];
			$worth=$row['worth'];
			$drecieve=$row['exp_arrival'];
			?>
	<table id="tab-myorderhistory" style="width:100%;border: 1px solid black;">
        <tr>
          <td><img src="<?php echo $product_image; ?>" width="120" height="120"></td>
        </tr>
        <tr>
          <td><?php echo "Order ID: ".$orderid;?></td>
        </tr>
        <tr>
          <td><?php echo "Product Name: ".$product_name;?></td>
        </tr>
        <tr>
          <td><?php echo "Quantity: ".$quantity;?></td>
        </tr>
        <tr>
          <td><?php echo "Worth: ".$worth;?> pesos</td>
        </tr>
        <tr>
          <td><?php echo "Date completed: ".$drecieve;?></td>
        </tr>
        </table>
        <?php }  }  ?>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>