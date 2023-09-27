<?php
include 'db.php';
session_start();
$riderid = $_GET["rider_id"];

$del = mysqli_query($conn, "DELETE FROM riders WHERE rider_id=$riderid");

header("Location:account_management.php");
?>