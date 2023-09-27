<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    h3{
      font-size: 15pt;
    }
    button{
      font-size: 15pt;
      border-radius: 3px;
    }
    #btnaddcust, #btnaddrider{
        color:black;
        background-color:teal;
        padding:5px;
        border-radius:3px;
        font-weight:bold;
    }
  </style>
</head>

<body>

  		<div class="nav-area" style="height:100%;width:250px;left:0;top:0;position:fixed;z-index:1;background-color: teal;" id="mySidebar">
  <button class="nav-close" style="color:white;width:100%;background-color: orange;border:0px;text-align:right;"
  onclick="nav_close()">&times;</button><br>
  <a href="adminpage.php" class="nav-option"><img src="thumbnails/sales.png" width="25" height="25">Sales Report</a><br>
  <a href="admin_notification.php" class="nav-option"><img src="thumbnails/notification.png" width="25" height="25">Notification</a><br>
  <a href="product_management.php" class="nav-option"><img src="thumbnails/product.png" width="25" height="25">Product Management</a><br>
  <a href="account_management.php" class="nav-option"><img src="thumbnails/account.png" width="25" height="25">Account Management</a><br>
  <a href="orders.php" class="nav-option"><img src="thumbnails/orders.png" width="25" height="25">Customer Orders</a><br>
  <a href="deliver.php" class="nav-option"><img src="thumbnails/delivering.png" width="25" height="25">On Delivery</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25"></a>


</div>

<div class="main" style="margin-right:200px;background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
</div>

</div>
<div style="width:100%;padding:2px;">
<center>
  <button id="btn-custaccount" onclick="show_customeraccount()" style="background-color:white;padding:7px;">Customers</button>
  <button id="btn-rideaccount" onclick="show_rideraccount()" style="background-color:teal;padding:7px;">Delivery riders</button>
</center>
<div id="form_customeraccount" style="width:100%;">
        <h3>Customers</h3>
<p></p>
<center>
      <a href="register.php" id="btnaddcust" class="btn-addproduct" style="font-size: 15px;">Add Customer</a>
</center>
      <p></p>
  
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM users WHERE role='customer'");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$userid=$row['id'];
			$profilepic=$row['profilepic'];
		  $fname=$row['fname'];
			$lname=$row['lname'];
			$email=$row['email'];
			?>
		<table class="tab-account" style="width:98%;margin:auto;border:1px solid black;margin-bottom:7px;">
        <tr>
          <td><?php echo "ID: ".$userid;?></td>
        </tr>
        <tr>
          <td><img src="<?php echo $profilepic; ?>" width="160" height="160"></td>
        </tr>
        <tr>
          <td><?php echo "First name: ".$fname; ?></td>
        </tr>
        <tr>
          <td><?php echo "Last name: ".$lname; ?></td>
        </tr>
        <tr>
          <td><?php echo "Email: ".$email; ?></td>
        </tr>
        <tr>
          <td><a href="edit_account.php?id=<?php echo $userid;?>" class="btn-update">Update Account</a><a href="delete_account.php?id=<?php echo $userid;?>" class="btn-delete">Remove</a></td>
            </tr>
      </table>
          <?php }  }  ?>
    </div>
    
    <div id="form_rideraccount" style="width:100%;display:none;">
  <p></p>
  <center><a href="add_del_ride.php" id="btnaddrider" class="btn-addproduct" style="font-size: 15px;">Add Delivery Rider</a></center>
  <p></p>
    <h3>Delivery Riders</h3>
  <p></p>
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM users WHERE role='rider'");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$id=$row['id'];
			$profilepic=$row['profilepic'];
		  $fname=$row['fname'];
		  $lname=$row['lname'];
			$email=$row['email'];
			?>
		  <table class="tab-account" style="width:98%;margin:auto;border:1px solid black;margin-bottom:7px;">
        <tr>
          <td><img src="<?php echo $profilepic; ?>" width="160" height="160"></td>
        </tr>
        <tr>
          <td><?php echo "ID: ".$id;?></td>
        </tr>
        <tr>
          <td><?php echo "First name: ".$fname; ?></td>
        </tr>
        <tr>
          <td><?php echo "Last name: ".$lname; ?></td>
        </tr>
        <tr>
          <td><?php echo "Email: ".$email; ?></td>
        </tr>
        <tr>
          <td><a href="edit_account.php?id=<?php echo $id;?>" class="btn-update">Update Account</a><a href="delete_account.php?id=<?php echo $id;?>" class="btn-delete">Remove</a></td>
        </tr>
      </table>
          <?php }  }  ?>
      </div>
    </div>
  <script src="js/script.js"></script>
</body>
</html>
