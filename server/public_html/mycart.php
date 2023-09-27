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
    <link rel="stylesheet" href="css/style.css"
  </head>
  <body>
    <div class="center">
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
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM orders WHERE customer_id=$userid AND order_status='order';");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$orderid=$row['order_id'];
			$product_image=$row['product_image'];
	   	$product_name=$row['product_name'];
	   	$sizes=$row['sizes'];
	   	$quantity=$row['quantity'];
			$worth=$row['worth'];
			$order_status=$row['order_status'];
			?>
      <table class="tab-mycart">
        <tr>
          <td><img src="<?php echo $product_image; ?>" width="160" height="160"></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo "Order ID: ".$orderid;?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo "Product Name: ".$product_name;?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo "Ordered size: ".$sizes;?></td>
        </tr>
        <tr>
          <td><?php echo "Quantity: ".$quantity;?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo "Worth: ".$worth." pesos";?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo "Order Status: ".$order_status;?></td>
        </tr>
        <tr style="text-align:center;">
          <td class="mycart-edit-btn"><a href="edit_order.php?order_id=<?php echo $orderid;?>" class="btn-edit-order">Edit</a></td>
          <td class="mycart-cancel-btn"><a href="cancel_order.php?order_id=<?php echo $orderid;?>" class="btn-cancel-order">Cancel</a></td>
        </tr>
          </table>
        <?php }  }  ?>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>