<?php
include 'db.php';
session_start();
$product_id = $_GET["product_id"];

$del = mysqli_query($conn, "DELETE FROM product_records WHERE product_id=$product_id");

echo "<script> location.href='product_management.php'; </script>";
?>