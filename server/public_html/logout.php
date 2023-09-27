<?php
session_start();
$_SESSION["id"] = "";
$_SESSION["rider_id"]="";
session_unset();
session_destroy();
// Redirect to the login page:
header('Location: login.php');
?>