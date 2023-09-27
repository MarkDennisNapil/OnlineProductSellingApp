<?php
include 'db.php';
session_start();
$rider_id=$_SESSION['rider_id'];

if(isset($_POST['upload_profilepic']))
{
	 $filename = $_FILES["image"]["name"];
    $target_dir = 'uploads/'.$filename;
	$target_file = $target_dir . basename($_FILES['image']['name']);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	$sql=mysqli_query($conn,"UPDATE riders SET profilepic='$target_file' WHERE rider_id=$rider_id");
	

if($sql)
    {
    	echo "Successfully uploaded profile picture!";  
    	echo "<script> location.href='delridepage.php'; </script>";
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
<link href="css/index.css" rel='stylesheet' type='text/css' />
</head>
<body>
	<center>
<legend>Profile Picture</legend>
<fieldset class="up-profilepic-field">
<form action="up_rider_profilepic.php" method="post" enctype="multipart/form-data">
	<table class="up-profilepic-tab">
	<tr>
		<td>Select Photo:</td>
		<td><input type="file" name="image" style="border: none;"></td>
	</tr>
</table>
	<input type="submit" name="upload_profilepic" class="btnupdprofilepic" value="Upload">
</form>
</fieldset>
</center>
</body>
</html>