<?php
include 'db.php';
session_start();
$order_id = $_GET["order_id"];
$rider_email=$_GET['email'];
$customer_id = $_GET['customer_id'];
$worth=$_GET['worth'];
$address=$_GET['address'];
$order_status='delivering';
$exp_arrival=date("Y/m/d");
$timenow=date("h:i a");

$del = mysqli_query($conn, "UPDATE orders SET order_status='$order_status',exp_arrival='$exp_arrival',delivered_by='$rider_email' WHERE order_id=$order_id");

$message="Admin approved your order[OrderID:".$order_id."] prepare payment amount ".$worth." pesos, delivery address at ".$address;
$notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever_id,reciever,description,message,time,date) VALUES ('admin','$customer_id','customer','On Delivery!','$message','$timenow','$exp_arrival')");
//rider 
 //---
  $getmail = mysqli_query($conn,"SELECT * FROM users WHERE id=$customer_id");
    if(mysqli_num_rows($getmail) > 0){
			while($row=mysqli_fetch_array($getmail)){
				
				$gemail=$row['email'];
				global $gemail;
			}
    }
$myemail=$GLOBALS['gemail'];
$to = $myemail;
$subject = "Order approved and delivering!";
$txt = $message;
$headers = "From: onlineproductsellingapp@gmail.com";
mail($to,$subject,$txt,$headers);
//rider email notif
$to = $rider_email;
$subject = "New delivery!";
$txt = "Please open the Online Product Selling App to view the pending delivery.";
$headers = "From: onlineproductsellingapp@gmail.com";
mail($to,$subject,$txt,$headers);

echo "<script> location.href='orders.php'; </script>";
?>