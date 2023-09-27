<?php
include 'db.php';
session_start();
$product_id = $_GET["product_id"];

if(isset($_POST['update_product']))
{
  $product_id=$_POST['uproductid'];
  $product_image=$_POST['uproductimage'];
  $product_name=$_POST['uproductname'];
  $price=$_POST['uprice'];
  $num_stock=$_POST['unum_stock'];
  
  $cart=mysqli_query($conn,"UPDATE product_records SET product_image='$product_image',product_name='$product_name',price='$price',num_stock='$num_stock' WHERE  product_id=$product_id");
	

if($cart)
    {
    	echo '<h1>Successfully updated the product!</h1>';  
    	echo "<script> location.href='product_management.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo '<h1>Error!</h1>'; 
    }
}
$query = mysqli_query($conn, "SELECT * FROM product_records WHERE product_id=$product_id");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$productid=$row['product_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
			$price=$row['price'];
			$num_stock=$row['num_stock'];
			$description=$row['description'];  
			global $productid, $product_image, $product_name, $price, $num_stock, $sizes;
?>
<html>
  <head>
    <title></title>
      <link rel="stylesheet" href="css/style.css">
    <style>
      input, textarea{
        font-size: 25pt;
        width: 100%;
      }
      p{
        font-size: 25pt;
      }
    </style>
  </head>
  <body>
    <div style="width:100%;padding:15px;background-color:whitesmoke;">
      <legend style="font-size:30pt;font-weight:bold;">Update Product</legend>
      <form action="update_product.php" method="post">
  <input type="hidden" id="uproductid" name="uproductid" value="  <?php $gpid = $GLOBALS['productid'];
  echo $product_id;
  ?>">
  <input type="hidden" id="xproductimage" name="uproductimage" value="  <?php $guppi = $GLOBALS['product_image'];
  echo $guppi;
  ?>">
  <p>Product Name:</p>
  <input type="text" id="uproductname" name="uproductname" value="  <?php $guppn = $GLOBALS['product_name'];
  echo $guppn;
  ?>">
  <p>Price:</p>
  <input type="text" id="uprice" name="uprice" value="  <?php $gadd = $GLOBALS['price'];
  echo $gadd;
  ?>">
  <p>Number of Stock:</p>
    <input type="text" id="unum_stock" name="unum_stock" value="  <?php $gupns = $GLOBALS['num_stock'];
  echo $gupns;
  ?>">
  <p>Description</p>
  <textarea id="udescription" name="udescription" value="<?php $gupd = $GLOBALS['sizes'];
  echo $gupd; ?>" cols="50" ="10" style="width:100%;height:auto;"></textarea><br>
  <input type="submit" name="update_product" class="btn-update" value="Update" style="font-size:25pt;padding:5px;margin-top:7px;background-color:teal;font-weight:bold;">
  </form>
  <?php }  }  ?>
  </div>
  </body>
</html>