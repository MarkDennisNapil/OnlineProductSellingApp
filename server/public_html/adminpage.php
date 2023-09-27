<?php
include 'db.php';
session_start();
$userid = $_SESSION['id'];
$urole = $_SESSION['role'];
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
    <a href="index.php" class="nav-option"><img src="thumbnails/profile.png" width="25" height="25">Switch to customer</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25"></a>


</div>

<div class="main" style="margin-right:200px;background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
</div>

</div>

        <form action="getsalesrecord.php" method="post" enctype="multipart/form-data">
    <h3>Browse sales data:</h3>
    <center>
    <input type="text" name="qsaledate" style="width:60%;padding:10px;border-left-radius:3px;" placeholder="yyyy-mm-dd">
    <input type="submit" name="getrecord" value="Get Data" style="width:30%;background-color:green;color:white;padding:10px;text-decoration:none;border-right-radius:3px;border:none;">
    </center>
    </form>
      <?php
      $today=date("Y/m/d");
      $sql = "SELECT  SUM(worth) FROM orders WHERE order_status='paid' AND exp_arrival='$today'";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)){
    ?>
        <h3>Today Total Sales:</h3>
            <p><?php echo $row['SUM(worth)']." pesos";
}
 ?></p>
       <?php
       $yesterday=date("Y-m-d", strtotime("yesterday")); 
      $sqlLD = "SELECT  SUM(worth) FROM orders WHERE order_status='paid' AND exp_arrival='$yesterday'";
$lastD = $conn->query($sqlLD);
while($yest = mysqli_fetch_array($lastD)){
    ?>
        <h3>Yesterday Total Sales:</h3>
            <p><?php echo $yest['SUM(worth)']." pesos";
}
 ?></p>
       <?php
       $thisMonth=date("Y-m");
      $sqlthisM = "SELECT  SUM(worth) FROM orders WHERE order_status='paid' AND exp_arrival LIKE '$thisMonth%'";
$thisM = $conn->query($sqlthisM);
while($Mrow = mysqli_fetch_array($thisM)){
    ?>
        <h3>This Month Total Sales:</h3>
            <p><?php echo $Mrow['SUM(worth)']." pesos";
}
 ?></p>
 <p style="outline-style: dotted;"></p>
    <h3>Sales History</h3>
              <?php 
      $query = mysqli_query($conn, "SELECT * FROM orders WHERE order_status='paid' ORDER BY exp_arrival DESC");
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
			$drecieve=$row['exp_arrival'];
			?>
	 <table class="tab-deliver" style="width:98%;border:1px solid black;margin:auto;margin-bottom:7px;">
	   <tr style="background-color:teal;">
        <td><?php echo "Order ID: ".$orderid; ?></td>
        </tr>
        <tr>
        <td>Customer ID: <a href="view_customer.php?customer_id=<?php echo $customerid;?>" style="color:blue;border-bottom:3px;border-bottom-style:dashed;"><?php echo $customerid;?></a></td>
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
          <td>Worth: </td>
        </tr>
        <tr>
        <td>$<?php echo "Worth: ".$worth; ?></td>
        </tr>
        <tr>
        <td><?php echo "Address: ".$address; ?></td>
        </tr>
        <tr>
        <td><?php echo "Date completed: ".$drecieve;?></td>
      </tr>
    </table>
          <?php }  }?>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>