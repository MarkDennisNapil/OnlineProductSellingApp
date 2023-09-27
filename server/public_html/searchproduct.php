<?php
include 'db.php';
session_start();
$userid=$_SESSION['id'];
  $prof = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");
    if(mysqli_num_rows($prof) > 0){
			while($row=mysqli_fetch_array($prof)){
				$profilepic=$row['profilepic'];
				$email=$row['email'];
				global $profilepic;
			}
    }else{
      
    }

?>
<!DOCTYPE html>
<html>
	<head>
	 <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		    <script src="notification.js"></script>
	</head>
	<body>
<div class="nav-area" style="height:100%;width:200px;left:0;top:0;position:fixed;z-index:1;background-color: teal;" id="mySidebar">
  <button class="nav-close" style="color:white;width:100%;background-color: orange;border:0px;text-align:right;"
  onclick="nav_close()">&times;</button><br>
  <a href="index.php" class="nav-option"><img src="thumbnails/home.png" width="25" height="25">Home</a><br>
  <a href="mycart.php" class="nav-option"><img src="thumbnails/cart.png" width="25" height="25">My Cart</a><br>
  <a href="customer_to_recieve.php" class="nav-option"><img src="thumbnails/cart2.png" width="25" height="25">My Order Records</a><br>
  <a href="notification.php" class="nav-option"><img src="thumbnails/notification.png" width="25" height="25">Notifications</a><br>
  <a href="profile.php" class="nav-option"><img src="thumbnails/myprofile.png" width="25" height="25">My Profile</a><br>
    <a href="adminswitch.php" class="nav-option"><img src="thumbnails/profile.png" width="25" height="25">Switch to admin</a><br>
  <a href="logout.php" class="nav-option"><img src="thumbnails/logout.png" width="25" height="25">Logout</a>


</div>

<div class="main" style="background-color: whitesmoke;width: 100%;">
<div class="nav-expand">
  <button class="btn-nav-expand" style="background-color:teal;border:0px;font-size: 35px;" onclick="nav_open()">&#9776;</button>
  <a><img src="<?php $profpic = $GLOBALS['profilepic']; 
      echo $profpic; ?>" class="profile-pic"></a>
      <h1></h1>
    <div style="padding-top:7px;padding-bottom:7px;">
    <center>
    <form action="searchproduct.php" method="post" enctype="multipart/form-data">
    <input type="text" name="txtsearch" style="width:95%;padding:8px;border-left-radius:3px;" placeholder="Search Jersey Product...">
    <input type="submit" name="search" value="Search" style="width:20%;background-color:teal;padding:9px;text-decoration:none;border-right-radius:3px;border:none;font-size:15px;display:none;">
    </form>
  </center>
  </div>

</div>
<div>
<div class="product_area" style="display: flex;
   flex-wrap: wrap;
   gap:7px;
   justify-content: center;padding-top:12px;">
    <?php 
    if(isset($_POST['search'])){
  $txtsearch=$_POST['txtsearch'];
    $result = mysqli_query($conn,"SELECT * FROM product_records WHERE product_name LIKE '%".$txtsearch."%'");
    if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_array($result)){
			 
				$product_id=$row['product_id'];
				$product_image=$row['product_image'];
				$product_name=$row['product_name'];
				$num_stock=$row['num_stock'];
				$sizes=$row['sizes'];
				$price=$row['price'];
	
?>
      <div class="img" style="box-shadow: var(--box-shadow);
   border:var(--border);
   position: relative;">
					<a href="fetch_product.php?product_id=<?php echo $product_id;?>">
					  <img src="<?php echo $product_image ?>" id="product_image" alt="Could not load image!">
					  </a>
					<div class="desc" style="font-size:15px;padding:3px;"><?php echo $product_name;?><br>
				  Price: <?php echo $price." pesos";?><br>Size: <?php echo $sizes;?><br>Stock: <?php echo $num_stock;?>
				  </div>
</div>
  				<?php
			}
		}
else{
			echo "<h1>0 result!</h1>";
		}
    }
	?>  
</div>
<script src="js/script.js"></script>
</body>
</html>