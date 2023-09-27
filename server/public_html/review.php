<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];

$product_id=$_GET['product_id'];
//get email
$getemail = "SELECT email FROM users WHERE id=$userid";
$thisEmail = $conn->query($getemail);
while($row = mysqli_fetch_array($thisEmail)){
  $gemail=$row['email'];
  global $gemail;
  echo $gemail;
}

if(isset($_POST['add_review']))
{
  $productid=$_POST['prod_id'];
	$rate=$_POST['rate'];
	$feedback=$_POST['feedback'];
	$custemail=$GLOBALS['gemail'];
	
	$sql=mysqli_query($conn,"INSERT INTO reviews (customerid,customeremail,productid,rate,text_review) VALUES ('$userid','$custemail','$productid','$rate','$feedback')");
	

if($sql)
    {
    	echo "Successfully added review!";  
    	echo "<script> location.href='customer_to_recieve.php'; </script>";
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
    font-size: 25pt;
  }
  p, input, textarea{
    font-size: 25pt;
    width: 100%;
  }
</style>
</head>
<body>
<h3 style="font-size:30pt;">Add Review</h3>
<div style="background-color:whitesmoke;padding:12px;">
<form action="review.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="prod_id" value="<?php echo $product_id; ?>">
				<p>Rate (1-5):</p>
				<input type="range" name="rate" min="1" max="5" placeholder="Range 0 to 5" required>
		<p>Feedback:</p>
		<textarea name="feedback" rows="10" cols="100" placeholder="Write review here..."></textarea>
	<input type="submit" name="add_review" class="add_review" id="add_review" value="Submit" style="background-color:teal;font-weight:bold;padding:7px;margin-top:7px;">
</form>
</div>
</body>
</html>