<?php
include 'db.php';
session_start();

if(isset($_POST['add_product']))
{
	 $filename = $_FILES["image"]["name"];
    $target_dir = 'uploads/'.$filename;
	$target_file = $target_dir . basename($_FILES['image']['name']);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	$product_name=$_POST['product_name'];
	$price=$_POST['price'];
	$num_stock=$_POST['num_stock'];
	$sizes=$_POST['sizes'];
	$description=$_POST['description'];
	
	$sql=mysqli_query($conn,"INSERT INTO product_records (product_image,product_name,price,num_stock,sizes,description) VALUES ('$target_file','$product_name','$price','$num_stock','$sizes','$description')");
	

if($sql)
    {
    	echo "Successfully added product!";  
    	echo "<script> location.href='product_management.php'; </script>";
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
  input{
    width: 100%;
    font-size: 15pt;
  }
  input[type=radio]{
    width: auto;
    font-size: 15pt;
  }
  input[type=submit]{
    font-size: 15pt;
    background-color:teal;
    padding: 7px;
    font-weight: bold;
    margin-top: 7px;
    border-radius: 3px;
  }
</style>
</head>
<body>
<form action="addproduct.php" method="post" enctype="multipart/form-data">
	<table class="addproduct-tab" style="width:98%;margin:auto;background-color:whitesmoke;padding:7px;">
	<tr>
	  <td><h3 style="font-size:15pt;font-weight:bold;background-color:whitesmoke;">Add Product</h3>
</td>
	</tr>
	<tr>
		<td>Attach Product Image:</td>
	</tr>
	<tr>
		<td><input type="file" name="image" style="border-radius: 4px;" required></td>
	</tr>
	<tr> 
				<td>Product Name:</td>
	</tr>
	<tr>
				<td><input type="text" name="product_name" style="padding: 7px;" required></td>
			</tr>
	<tr>
		<td>Price:</td>
	</tr>
	<tr>
		<td><input type="text" name="price" style="padding: 7px;" required></td>
	</tr>
	<tr>
		<td>Number of Stocks:</td>
	</tr>
	<tr>
		<td><input type="text" name="num_stock" style="padding: 7px;" required></td>
	</tr>
	<tr>
		<td>Sizes:</td>
	</tr>
	<tr>
		<td>
		<label><input type="radio" name="sizes" value="XS">XS</label>
		<label><input type="radio" name="sizes" value="S">S</label>
		<label><input type="radio" name="sizes" value="M">M</label>
		<label><input type="radio" name="sizes" value="L">L</label>
		<label><input type="radio" name="sizes" value="XL">XL</label>
		<label><input type="radio" name="sizes" value="XXL">XXL</label></td>
	</tr>
	<tr>
		<td>Description:</td>
	</tr>
	<tr>
		<td><input type="textarea" name="description" style="padding: 7px;"></td>
	</tr>
	<tr>
	  <td><input type="submit" name="add_product" id="add_product" class="btn-addproduct" value="Add"></td>
	</tr>
</table>
</form>
</body>
</html>