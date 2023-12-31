<?php
include 'db.php';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div style="width:100%;">
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
<p></p>
<center>
      <a href="addproduct.php" class="btn-addproduct" style="font-size: 15pt;margin-top:10px;padding:5px;color:black;background-color:teal;font-weight:bold;border-radius:3px;">Add</a>
</center>
      <p></p>
  <div style="display: flex;
   flex-wrap: wrap;
   gap:7px;
   justify-content: center;padding-top:12px;">
        <?php 
        $query = mysqli_query($conn, "SELECT * FROM product_records");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$productid=$row['product_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
			$price=$row['price'];
			$num_stock=$row['num_stock'];
			$sizes=$row['sizes'];
			$description=$row['description'];  ?>
		<table class="tab-product" style="width:46%;box-shadow: var(--box-shadow);
   border:var(--border);
   position: relative;background-color:whitesmoke;padding-bottom:5px;">
        <tr>
          <td><?php echo $productid;?></td>
        </tr>
        <tr>
          <td><img src="<?php echo $product_image; ?>" style="width:100%;height:auto;"></td>
        </tr>
        <tr>
          <td><?php echo "Product name: ".$product_name; ?></td>
        </tr>
        <tr>
          <td><?php echo "Price: ".$price; ?></td>
        </tr>
          <tr>
          <td><?php echo "Stock: ".$num_stock; ?></td>
        </tr>
        <tr>
          <td style="text-align:center;color:black;"><a href="update_product.php?product_id=<?php echo $productid;?>" class="btn-update" style="margin-bottom:3px;color:black;background-color:teal;padding:5px;">Update</a>
          <a href="delete_product.php?product_id=<?php echo $productid;?>" class="btn-delete" style="color:black;background-color:teal;padding:5px;">Delete</a></td>
        </tr>
      </table>
          <?php }  }  ?>
        
    </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
