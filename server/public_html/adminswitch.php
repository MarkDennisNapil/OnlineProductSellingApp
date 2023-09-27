<?php
include 'db.php'; 
session_start();

$userid = $_SESSION['id'];
$urole = $_SESSION['role'];
if(!isset($userid)){
   echo "<h1>Login First!</h1>";
   echo "<script> location.href='login.php'; </script>";
}



    $prof = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");
    if(mysqli_num_rows($prof) > 0){
			while($row=mysqli_fetch_array($prof)){
				$profilepic=$row['profilepic'];
				$email=$row['email'];
				$role=$row['role'];
    
    if ($role=="master"){
      echo "<script> location.href='adminpage.php'; </script>";
    }
			
    else{
      echo "<h1>Account not allow!</h1>";
      echo "<script> location.href='index.php'; </script>";
    }
    }
    }
?>