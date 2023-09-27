<?php
include 'db.php';
session_start();
$id=$_SESSION['id'];
$prof = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
    if(mysqli_num_rows($prof) > 0){
			while($row=mysqli_fetch_array($prof)){
				$profilepic=$row['profilepic'];
				$email=$row['email'];
				global $email,$profilepic;
			}
    }else{
      
    }
$email=$_SESSION['email'];
if(!isset($id)){
   echo "<script> location.href='login.php'; </script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    <title></title>
      <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    		<div class="nav-area" style="height:100%;width:200px;left:0;top:0;position:fixed;z-index:1;background-color: teal;" id="mySidebar">
  <button class="nav-close" style="color:white;width:100%;background-color: orange;border:0px;text-align:right;"
  onclick="nav_close()">&times;</button><br>
  <a href="delridepage.php" class="nav-option"><img src="thumbnails/rider.png" width="25" height="25">To deliver</a><br>
  <a href="del_history.php" class="nav-option"><img src="thumbnails/deliverhistory.png" width="25" height="25">Delivery history</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25"></a>


</div>

<div class="main" style="margin-right:200px;background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
  <img src="<?php $profpic = $GLOBALS['profilepic']; 
      echo $profpic; ?>" class="profile-pic">
</div>

</div>
<div style="width:100%;background-color:whitesmoke;">
      <h3>Delivery History</h3>
              <?php 
      $query = mysqli_query($conn, "SELECT * FROM orders WHERE delivered_by='$email' ORDER BY exp_arrival DESC");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
      $orderid=$row['order_id'];
			$customerid=$row['customer_id'];
			$productid=$row['product_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
		$sizes=$row['sizes'];
		$quantity=$row['quantity'];
			$worth=$row['worth'];
			$status=$row['order_status'];
			$address=$row['address'];
			$drecieve=$row['exp_arrival'];
			?>
		<table class="tab-deliver" style="width:97%;margin:auto;border:1px solid black;border-radius:3px;margin-bottom:7px;">
		  <tr>
        <td style="background-color:teal;"><?php echo "Order ID: ".$orderid; ?></td>
      </tr>
      <tr>
        <td><?php echo "Customer ID: ".$customerid;?></td>
      </tr>
      <tr>
        <td><?php echo "Product name: ".$product_name; ?></td>
      </tr>
      <tr>
        <td><?php echo "Size: ".$sizes; ?></td>
      </tr>
      <tr>
        <td><?php echo "Quantity: ".$quantity; ?></td>
      </tr>
      <tr>
        <td><?php echo "Worth: ".$worth; ?></td>
      </tr>
      <tr>
        <td><?php echo "Status: ".$status; ?></td>
      </tr>
      <tr>
        <td><?php echo "Address: ".$address; ?></td>
      </tr>
      <tr>
        <td><?php echo "Date completed: ".$drecieve;?></td>
      </tr>
    </table>
          <?php }  }
          else{
            echo "<h1>No delivered order yet!</h1>";
          }?>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>