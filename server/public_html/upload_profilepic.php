<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];

if(isset($_POST['upload_profilepic']))
{
	 $filename = $_FILES["image"]["name"];
    $target_dir = 'uploads/'.$filename;
	$target_file = $target_dir . basename($_FILES['image']['name']);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	
	$sql=mysqli_query($conn,"UPDATE users SET profilepic='$target_file' WHERE  id=$userid");
	

if($sql)
    {
    	echo "Successfully uploaded profile picture!";  
    	echo "<script> location.href='profile.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo "Error!"; 
    }
}

?>
<html>
<head>
<title>Online Product Selling System</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>
body{
  font-size: 12pt;
}
  input[type=submit]{
    width: 100%;
    background-color: teal;
    font-size: 12pt;
    font-weight: bold;
    padding:7px;
  }
</style>
</head>
<body>
<div style="width:100%;">
  <h3>Profile Picture</h3>
<form action="upload_profilepic.php" method="post" enctype="multipart/form-data">
	<table class="up-profilepic-tab" style="width:100%;background-color:whitesmoke;">
	<tr>
		<td style="font-size:12pt;">Select Photo:</td>
		<td><input type="file" name="image" style="border: none;font-size:12pt;"></td>
	</tr>
</table>
<input type="submit" name="upload_profilepic" class="btnupdprofilepic" style="width:100%;" onclick="button_click()" value="Upload">
</form>
</div>
<script src="js/script.js"></script>
</body>
</html>