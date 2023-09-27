<?php
include 'db.php';
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email'];
$prof = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
    if(mysqli_num_rows($prof) > 0){
			while($row=mysqli_fetch_array($prof)){
				$profilepic=$row['profilepic'];
				$email=$row['email'];
				$role=$row['role'];
				global $email,$profilepic;
    if ($role=="admin"){
      header('location:adminpage.php');
    }
    else{
    }
    }
}
if(!isset($id)){
   header('location:login.php');
};
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
      <style>
        body{
          font-size: 15pt;
        }
      </style>
  </head>
  <body>
    		<div class="nav-area" style="height:100%;width:200px;left:0;top:0;position:fixed;z-index:1;background-color: teal;" id="mySidebar">
  <button class="nav-close" style="color:white;width:100%;background-color: orange;border:0px;text-align:right;"
  onclick="nav_close()">&times;</button><br>
  <a href="delridepage.php" class="nav-option"><img src="thumbnails/rider.png" width="25" height="25">To deliver</a><br>
  <a href="del_history.php" class="nav-option"><img src="thumbnails/deliverhistory.png" width="25" height="25">Delivery history</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25"></a>


</div>

<div class="main" style="margin-right:200px;background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
  <img src="<?php $profpic = $GLOBALS['profilepic']; 
      echo $profpic; ?>" class="profile-pic">
</div>

</div>
<div style="width:100%;background-color:whitesmoke;">
              <?php 
      $query = mysqli_query($conn, "SELECT * FROM orders WHERE delivered_by='$email' AND order_status='delivering'");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
      $orderid=$row['order_id'];
			$customerid=$row['customer_id'];
			$productid=$row['product_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
		$sizes=$row['sizes'];
		$quantity=$row['quantity'];
			$worth=$row['worth'];
			$address=$row['address'];
			global $orderid, $customerid, $productid,$product_image,$product_name,$sizes,$quantity,$worth,$address;
			?>
	<table class="tab-deliver" style="width:97%;margin:auto;margin-bottom:7px;border:1px solid black;border-radius:3px;">
      <tr>
        <td style="background-color:teal;"><?php echo "Order ID: ".$orderid; ?></td>
      </tr>
      <tr>
        <td>Customer ID: <?php echo $customerid;?></td>
      </tr>
      <tr>
        <td><?php echo "Product name: ".$product_name; ?></td>
      </tr>
      <tr>
        <td><?php echo "Size: ".$sizes; ?></td>
      </tr>
      <tr>
        <td><?php echo "Quantity: ".$quantity; ?></td>
      </tr>
      <tr>
        <td><?php echo "Worth: ".$worth; ?></td>
      </tr>
      <tr>
        <td><?php echo "Address: ".$address; ?></td>
      </tr>
      <tr style="display:flex;justify-content:center;">
        <td><a href="order_delivered.php?order_id=<?php echo $orderid;?>&customer_id=<?php echo $customerid;?>&worth=<?php echo $worth;?>&address=<?php echo $address;?>&id=<?php echo $id;?>&email=<?php echo $email;?>" class="btn-approve" style="border-radius:3px;">Delivered</a></td>
      </tr>
    </table>
          <?php }  }?>
 </div>
 <script src="js/script.js"></script>
  </body>
</html>