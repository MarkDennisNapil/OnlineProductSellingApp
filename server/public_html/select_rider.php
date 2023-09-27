<?php
include 'db.php';
session_start();
$order_id=$_GET['order_id'];
$customer_id=$_GET['customer_id'];
$worth=$_GET['worth'];
$address=$_GET['address'];
global $customer_id, $worth;
if (empty($_POST["rider_select"])) {
    echo "<h1>Please select delivery rider</h1>";
  } 
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
      <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <center>
      <form action="deliver_order.php" method="post">
      	<select name="rider_select" style="width: 98%;margin:auto;
  padding: 7px;
  border:1px solid black;
  border-radius: 3px;
  background-color: white;">
    <?php
      $query = mysqli_query($conn, "SELECT * FROM users WHERE role='rider'");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$fname=$row['fname'];
			$lname=$row['lname'];
			$email=$row['email'];
	    global $email;
			?>
  <option value="<?php echo $email; ?>"><?php echo $fname." ".$lname."--|--".$email; ?></option>
  <?php
} }else{
  echo "<h1>No available delivery rider!</h1>";
}  ?>
  </select>
  <?php
  $get_email=$GLOBALS['email']; ?>
  <p></p>
  <a href="deliver_order.php?order_id=<?php echo $order_id;?>&email=<?php echo $get_email;?>&customer_id=<?php echo $customer_id;?>&worth=<?php echo $worth;?>&address=<?php echo $address;?>" class="btn-approve" style="color:black;background-color:teal;border-radius:3px;float:right;margin-right:1%;text-decoration:none;padding:5px">Confirm</a>
  </form>
  </center>
  </body>
</html>