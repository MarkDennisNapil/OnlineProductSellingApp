<?php
include 'db.php';
session_start();
$userid=$_GET['id'];
$order_id = $_GET["order_id"];
$rider_email=$_GET['email'];
$customer_id = $_GET['customer_id'];
$worth=$_GET['worth'];
$address=$_GET['address'];
$exp_arrival=date("Y/m/d");
$timenow=date("h:i a");


$del = mysqli_query($conn, "UPDATE orders SET order_status='delivered', exp_arrival='$exp_arrival' WHERE order_id=$order_id");

//notification

$message="Rider: ".$rider_email." successfully delivered order OrderID[".$order_id."]";
$notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever_id,reciever,description,message,time,date) VALUES ('$rider_email','$customer_id','admin','Successfully delivered!','$message','$timenow','$exp_arrival')");
//email notif to admin
$getmail = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");
    if(mysqli_num_rows($getmail) > 0){
			while($row=mysqli_fetch_array($getmail)){
				
				$gemail=$row['email'];
				global $gemail;
			}
    }
$myemail=$GLOBALS['gemail'];
$to = "onlineproductsellingapp@gmail.com";
$subject = "Order successfully delivered!";
$txt = $message;
$headers = "From: ".$myemail;
mail($to,$subject,$txt,$headers);

echo "<script> location.href='delridepage.php'; </script>";
?>