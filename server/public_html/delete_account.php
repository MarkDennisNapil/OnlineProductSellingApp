<?php
include 'db.php';
session_start();
$userid = $_GET["id"];

$del = mysqli_query($conn, "DELETE FROM users WHERE id=$userid");

header("Location:account_management.php");
?>