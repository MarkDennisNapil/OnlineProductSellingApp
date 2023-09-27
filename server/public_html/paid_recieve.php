<?php
include 'db.php';
session_start();
$order_id = $_GET["order_id"];
$order_status='paid';
$exp_arrival=date("Y/m/d");
$timenow=date("h:i a");

$del = mysqli_query($conn, "UPDATE orders SET order_status='$order_status', exp_arrival='$exp_arrival' WHERE order_id=$order_id");

//product count deduction
$getproduct = mysqli_query($conn,"SELECT * FROM orders WHERE order_id=$order_id");
    if(mysqli_num_rows($getproduct) > 0){
			while($row=mysqli_fetch_array($getproduct)){
				$gquant=$row['quantity'];
				$gproduct=$row['product_id'];
				global $gproduct, $gquant;
			}
    }
$prodid=$GLOBALS['gproduct'];
$getstock = mysqli_query($conn,"SELECT * FROM product_records WHERE product_id=$prodid");
    if(mysqli_num_rows($getstock) > 0){
			while($row=mysqli_fetch_array($getstock)){
				
				$gstock=$row['num_stock'];
				global $gstock;
			}
    }
$gquantity=$GLOBALS['gquant'];
$gnumstock=$GLOBALS['gstock'];
$newnum_stock=$gnumstock-$gquantity;
$updatestock=mysqli_query($conn,"UPDATE product_records SET num_stock='$newnum_stock' WHERE  product_id=$prodid");
	

echo "<script> location.href='deliver.php'; </script>";
?>