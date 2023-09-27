<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/style.css">
  <style>
     tr, td{
          width:100%;
      }
  </style>
</head>

<body>

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
<p></p>
<h3>Customers order</h3>
<p></p>
  <div style="width:100%;">
              <?php 
      $order='order';
      $query = mysqli_query($conn, "SELECT * FROM orders WHERE order_status='$order'");
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
	    <table class="tab-orders" style="width:98%;margin:auto;border:1px solid black;margin-bottom:7px;display:block;border-radius:2px;background-color:whitesmoke;">
      <tr>
        <td><?php echo "Order ID: ".$orderid; ?></td>
      </tr>
      <tr>
        <td>Customer ID: <a href="view_customer.php?customer_id=<?php echo $customerid;?>" name="view-customer" class="view-customer" style="color:blue;border-bottom:3px;border-bottom-style:dashed;"><?php echo $customerid; ?></a></td>
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
      <tr>
        <td><a href="select_rider.php?order_id=<?php echo $orderid;?>&customer_id=<?php echo $customerid;?>&worth=<?php echo $worth;?>&address=<?php echo $address;?>" class="btn-approve">Deliver</a><a href="remove_order.php?order_id=<?php echo $orderid;?>&customer_id=<?php echo $customerid;?>&worth=<?php echo $worth;?>&address=<?php echo $address;?>" class="btn-cancel" style="float:left;margin-left:7px;">Cancel</a></td>
      </tr>
    </table>
          <?php }  }?>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
