<?php 
include 'db.php';
session_start();

$userid=$_SESSION['id'];
$product_id = $_GET['product_id'];
global $product_id;
$getmail = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");
    if(mysqli_num_rows($getmail) > 0){
			while($row=mysqli_fetch_array($getmail)){
				
				$gemail=$row['email'];
				global $gemail;
			}
    }

if(isset($_POST['addtocart']))
{
  $productid=$_POST['xproductid'];
  $product_image=$_POST['xproductimage'];
  $product_name=$_POST['xproductname'];
  $price=$_POST['xprice'];
  $quantity=$_POST['xquantity'];
  $worth=$quantity*$price;
  $sizes=$_POST['xsizes'];
  $address=$_POST['xaddress'];
  $order_status=$_POST['xorder_status'];
  $today=date("Y/m/d");
  $message="CustomerID_".$userid." ordered ".$product_name."  quantity=".$quantity." and size=".$sizes." with total worth of ".$worth." pesos";
 
  $timenow=date("h:i a");
  $notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever,description,message,time,date) VALUES ('$userid','admin','New order!','$message','$timenow','$today')");
	
  //email notif
  $myemail=$GLOBALS['gemail'];
$to = "onlineproductsellingapp@gmail.com";
$subject = "New Order! Open Online Product Selling App for Jersey Product by Guinggue and Giray";
$txt = $message;
$headers = "From: ".$myemail;


mail($to,$subject,$txt,$headers);
  
  $cart=mysqli_query($conn,"INSERT INTO orders (customer_id,product_id,product_image,product_name,price,worth,quantity,sizes,address,order_status, exp_arrival) VALUES ('$userid','$productid','$product_image','$product_name','$price','$worth','$quantity','$sizes','$address','order','$today')");
	

if($cart)
    {
    	echo '<h1>Successfully added to cart!</h1>';  
    	echo "<script> location.href='index.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo '<h1>Error!</h1>'; 
    }
}
//add to notification
if(isset($_POST['addtocart']))
{
  $product_id=$_POST['xproductid'];
  $product_image=$_POST['xproductimage'];
  $product_name=$_POST['xproductname'];
  $price=$_POST['xprice'];
  $quantity=$_POST['xquantity'];
  $worth=$quantity*$price;
  $sizes=$_POST['xsizes'];
  $message="CustomerID_".$userid." ordered ".$product_name."  quantity=".$quantity." and size=".$sizes." with total worth of ".$worth." pesos";
  $today=date("Y/m/d");
  $timenow=date("h:i a");
  $notify=mysqli_query($conn,"INSERT INTO notifications (sender,reciever,description,message,time,date) VALUES ('$userid','admin','New order!','$message','$timenow','$today')");
	

if($notify)
    {
    	echo '<h1>Successfully notify!</h1>';  
    	echo "<script> location.href='index.php'; </script>";
    }
    else
    {
	echo $conn->error;    
	echo '<h1>Error!</h1>'; 
    }
}

//db add to cart 

$getacc = mysqli_query($conn,"SELECT * FROM users WHERE id=$userid");

if(mysqli_num_rows($getacc) > 0){
			while($row=mysqli_fetch_array($getacc)){
			$userid=$row['id'];
			$fname=$row['fname'];
			$lname=$row['lname'];
			$sex=$row['sex'];
			$phone=$row['phone'];
			$email=$row['email'];
			$bday=$row['bday'];
			$txtaddress=$row['txtaddress'];
		  global $fname, $lname, $sex, $phone, $email, $bday, $txtaddress;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
   <title>Online Product Selling System</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
    body{
        background-color:whitesmoke;
        font-size:12pt;
    }
    p{
        font-size:12pt;
        border-bottom:1px;
    }
</style>
</head>
<body>
  <div class="center" style="padding: 12px;">
      <a href="index.php" style="float:right;"><img src="thumbnails/x.png" width="35" height="35"></a>
  <form action="fetch_product.php" method="post">
  <table style="display:none;">
    <tr>
      <td id="tduserid"><?php echo $userid;?></td>
    </tr>
    						<tr>
						<td>First:</td>
						<td id="tdfname"><?php echo $fname;?></td>
						</tr>
						<tr>
					  <td>Lastname:</td>
					  <td id="tdlname"><?php echo $lname;?></td>
					</tr>
						<tr>
					  <td>Sex:</td>
					  <td id="tdsex"><?php echo $sex;?></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td id="tdphone"><?php echo $phone;?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td id="tdemail"><?php echo $email;?></td>
					</tr>
			<tr>
						<td>Birthdate:</td>
						<td id="tdbday"><?php echo $bday;?></td>
					<tr>
						<td>Address:</td>
						<td id="tdaddress"><?php echo $txtaddress;  }  }?></td>
					</tr>
				</table>
	
				<?php 
			$query = mysqli_query($conn, "SELECT * FROM product_records WHERE product_id=$product_id");
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_array($query)){
			$productid=$row['product_id'];
			$product_image=$row['product_image'];
		$product_name=$row['product_name'];
			$price=$row['price'];
			$num_stock=$row['num_stock'];
			$sizes=$row['sizes'];
			$description=$row['description'];  
			global $productid, $product_image, $product_name, $price, $num_stock, $sizes;
			?>
				
				
  <div class="v_img">
<p id="divproduct_id" style="display:none;"><?php echo $productid;?></p>
<p id="divproduct_image" style="display: none;"><?php echo $product_image;?></p>
<img src="<?php echo $product_image;?>" alt="image load failed!" class="product-image-fetch">
<p id="divproduct_id" style="display: none;"><?php echo $productid;?></p>
 <?php
  $query = mysqli_query($conn, "SELECT SUM(quantity) FROM orders WHERE product_id=$product_id AND order_status='paid'");
while($row=mysqli_fetch_array($query)){
			$sold=$row['SUM(quantity)'];
			
		global $sold; 
		?>
		<p><?php echo "Item sold: ".$sold; ?></p>
		<?php
}
		?>

		<?php
		$query = mysqli_query($conn, "SELECT AVG(rate) FROM reviews WHERE productid=$product_id");
while($row=mysqli_fetch_array($query)){
			$resrate=$row['AVG(rate)'];
			
		global $resrate; 
		?>
		<p><?php echo "Rating: ".$resrate; ?> 
		</p>
		<?php
}
		?>
<p>Product Name: <?php echo $product_name;?></p>
<p>Price: <?php echo $price." pesos";?></p>
<p>Number of stock: <?php echo $num_stock;?></p>
<p>Size: <?php echo $sizes;?></p>
<p>Description:</p>
<p><?php echo $description;?></p>
<p>Quantity (<?php echo $num_stock." stock/s left";?>):<br>
  </p>
</div>
<?php
}
}
?>
</form>
  <form action="fetch_product.php" method="post">
  <input type="text" id="xuserid" name="xuserid" value="  <?php $guid = $GLOBALS['userid'];
  echo $userid;
  ?>" style="display: none;">
  <input type="text" id="xproductid" name="xproductid" value="  <?php $gpid = $GLOBALS['product_id'];
  echo $product_id;
  ?>" style="display: none;">
  <input type="text" id="xproductimage" name="xproductimage" value="  <?php $gpi = $GLOBALS['product_image'];
  echo $gpi;
  ?>" style="display: none;">
  <input type="text" id="xproductname" name="xproductname" value="  <?php $gpn = $GLOBALS['product_name'];
  echo $gpn;
  ?>" style="display: none;">
  <input type="text" id="xaddress" name="xaddress" value="  <?php $gadd = $GLOBALS['txtaddress'];
  echo $gadd;
  ?>" style="display: none;">
    <input type="hidden" id="xprice" name="xprice" value="  <?php $gp = $GLOBALS['price'];
  echo $gp;
  ?>" style="display: none;">
    <input type="text" id="xsizes" name="xsizes" value="  <?php $gs = $GLOBALS['sizes'];
  echo $gs;
  ?>" style="display: none;">
  <input type="number" id="xquantity" name="xquantity" style="width:95%;padding: 10px;margin:auto;" min="1" max="<?php echo $num_stock; ?>" placeholder="Quantity of product/s to order..." required><br>
  <input type="hidden" id="xorder_status" name="xorder_status" value="order">
  <input type="hidden" id="xworth">
  <input type="submit" class="btnaddtocart" style="border:0px;" name="addtocart" value="Add to cart">
  </form>
  </div>
  <div class="center" style="margin-top: 12px;">
    <fieldset>
      <legend style="font-size: 12pt;">Reviews</legend>
      <?php
    $query = mysqli_query($conn, "SELECT * FROM reviews WHERE productid=$product_id");
while($row=mysqli_fetch_array($query)){
		  $cusemail=$row['customeremail'];
			$cusrate=$row['rate'];
			$txtrev=$row['text_review'];
			
		global $cusrate; 
		?>
    <table style="border-radius: 15px; border: 0px; width: 90%;" class="tab-review">
		<tr>
		<td class="email-rev">by: <?php echo $cusemail; ?> 
		</td></tr>
		<tr>
		<td class="rate-rev">Rated: <?php echo $cusrate; ?> 
		</td></tr>
		<tr>
		<td class="comm-rev"><p>Comment: <?php echo $txtrev; ?> 
		</p></td></tr>
		</table>
		<?php
}
?>
</fieldset>
  </div>
  <script src="js/script.js"></script>
</body>
</html>