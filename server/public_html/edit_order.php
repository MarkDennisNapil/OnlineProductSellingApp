<?php
include 'db.php';
session_start();
$order_id = $_GET["order_id"];

if(isset($_POST['edit_order']))
{
  $order_id=$_POST['uorderid'];
  $price=$_POST['uprice'];
  $quantity=$_POST['uquantity'];
  $address=$_POST['uaddress'];
  $worth=$price*$quantity;
  
  $cart=mysqli_query($conn,"UPDATE orders SET quantity='$quantity',address='$address',worth='$worth' WHERE  order_id=$order_id");
	

if($cart)
    {
    	echo '<h1>Successfully updated the product!</h1>';  
    	echo "<script> location.href='mycart.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo '<h1>Error!</h1>'; 
    }
}
//fetch my orders

$query = mysqli_query($conn, "SELECT * FROM orders WHERE order_id=$order_id");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$orderid=$row['order_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
		$price=$row['price'];
			$quantity=$row['quantity'];
			$sizes=$row['sizes'];
			$address=$row['address'];  
			global $orderid, $product_image, $product_name, $price, $quantity, $sizes, $address;
?>
<html>
  <head>
  <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    <title>Edit My Order</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      body{
        font-size: 15pt;
      }
      input, textarea{
        font-size: 15pt;
        width: 100%;
      }
    </style>
  </head>
  <body>
 <div style="width:98%;margin:auto;background-color:whitesmoke;padding:7px;">
      <h3>Edit My Order</h3>
      <form action="edit_order.php" method="post">
  <input type="hidden" id="uorderid" name="uorderid" value="  <?php $gpid = $GLOBALS['orderid'];
  echo $order_id;
  ?>">
  <img src="<?php echo $product_image; ?>" class="product-image-fetch">
  <p>Product Name:</p>
  <p><?php echo $product_name;
  ?></p>
    <input type="hidden" id="uprice" name="uprice" value="  <?php $gup = $GLOBALS['price'];
  echo $gup;
  ?>">
  <p>Quantity Ordered:</p>
  <input type="text" id="uquantity" name="uquantity" value="  <?php $guq = $GLOBALS['quantity'];
  echo $guq;
  ?>">
  <p>Size:</p>
 <p><?php echo $sizes; ?></p>
 <p>Delivery Address:</p>
  <textarea id="uaddress" name="uaddress" value="<?php $gupadd = $GLOBALS['address'];
  echo $gupadd; ?>" cols="50" rows="5"><?php $gupadd=$GLOBALS['address']; echo $gupadd;?></textarea><br>
  <input type="submit" name="edit_order" class="reg-link" style="background-color:teal;font-weight:bold;padding:7px;margin-top:7px;" value="Done">
  </form>
  <?php }  }  ?>
  </div>
  </body>
</html>