<?php
$servername = "localhost";
$username = "id19805831_opsa_2022";
$password = "7uau]86c&{7Fq]/9";
$dbname = "id19805831_opsa"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>