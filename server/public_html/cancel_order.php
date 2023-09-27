<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];
$order_id = $_GET["order_id"];
$order_status='cancel';
$today=date("Y/m/d");

$del = mysqli_query($conn, "UPDATE orders SET order_status='$order_status' WHERE order_id=$order_id");
  $message="CustomerID: ".$userid." cancelled order [OrderID=".$order_id."]";
 
  $timenow=date("h:i a");
  $notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever,description,message,time,date) VALUES ($userid,'admin','Order Cancelled!','$message','$timenow','$today')");
	
  

echo "<script> location.href='mycart.php'; </script>";
?>