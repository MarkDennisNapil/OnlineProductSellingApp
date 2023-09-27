<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];
$order_id = $_GET["order_id"];
$order_status='paid';
$exp_arrival=date("Y/m/d");
$timenow=date("h:i a");

$del = mysqli_query($conn, "UPDATE orders SET order_status='$order_status', exp_arrival='$exp_arrival' WHERE order_id=$order_id");
  
$message="CustomerID_".$userid." recieved and paid order[OrderID:".$order_id."] date recieved:".$exp_arrival;
$notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever,description,message,time,date) VALUES ('$userid','admin','Order recieved!','$message','$timenow','$exp_arrival')");
?>
<!DOCTYPE html>
<html>
  <head>
    	 <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>Order Recieved</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <center>
       <?php 
        $sql = "SELECT product_id FROM orders WHERE order_id=$order_id";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)){
  $product_id=$row['product_id'];
  
			?>
    <a href="review.php?product_id=<?php echo $product_id;?>" style="font-size: 30px; border-radius: 3px; background-color: green; color: white; padding: 7px; font-weight: bold;width:100%;">Write Review</a>
    <?php }  ?>
    <a href="customer_to_recieve.php" style="font-size: 30px; border-radius: 3px; background-color: red; color: white; padding: 7px; font-weight: bold;width:100%;">Later</a>
    </center>
  </body>
</html>