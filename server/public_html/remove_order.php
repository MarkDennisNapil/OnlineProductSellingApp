<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];
$order_id = $_GET["order_id"];
$customer_id=$_GET['customer_id'];
$today=date("Y/m/d");
$timenow=date("h:i a");

$del = mysqli_query($conn, "DELETE FROM orders WHERE order_id=$order_id");

$message="Admin[AdminID:".$userid."] cancelled/disapproved your order[OrderID:".$order_id."]";
$notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever_id,reciever,description,message,time,date) VALUES ('$userid','$customer_id','customer','Cancelled!','$message','$timenow','$today')");
echo $message;
//email notif
$getmail = mysqli_query($conn,"SELECT * FROM users WHERE id=$customer_id");
    if(mysqli_num_rows($getmail) > 0){
			while($row=mysqli_fetch_array($getmail)){
				
				$gemail=$row['email'];
				global $gemail;
			}
    }
$myemail=$GLOBALS['gemail'];
$to = $myemail;
$subject = "Order cancelled!";
$txt = $message;
$headers = "From: onlineproductsellingapp@gmail.com";
mail($to,$subject,$txt,$headers);
   echo "<script> location.href='orders.php'; </script>";
?>