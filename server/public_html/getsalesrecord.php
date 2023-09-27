<?php
include 'db.php';
if(isset($_POST['getrecord'])){
  $qdate=$_POST['qsaledate'];
  global $qdate;
}
$thisqdate=$GLOBALS['qdate'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    <title></title>
      <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <a href="adminpage.php" style="font-size:15pt;font-weight:bold;background-color:teal;color:black;padding-left:5px;padding-right:5px;"><</a>
<div style="width:100%;background-color:whitesmoke;padding:auto;">
     <?php
      $sql = "SELECT  SUM(worth) FROM orders WHERE exp_arrival LIKE '$thisqdate%' AND order_status='paid'";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)){
    ?>
        <h4>Date: <?php echo $thisqdate;?></h4>
            <h4>Total sales: <?php echo $row['SUM(worth)']." pesos";
}
 ?></h4>
<h3>Sales History</h3>
              <?php 
              
      $query = mysqli_query($conn, "SELECT * FROM orders WHERE exp_arrival LIKE '$thisqdate%' AND order_status='paid' ORDER BY exp_arrival DESC");
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
			$address=$row['address'];
			$drecieve=$row['exp_arrival'];
			?>
		<table class="tab-deliver" style="width:98%;border:1px solid black;margin:auto;margin-bottom:7px;">
		  <tr>
        <td style="background-color:teal;"><?php echo "Order ID: ".$orderid; ?></td>
      </tr>
      <tr>
        <td>Customer ID: <a href="view_customer.php?customer_id=<?php echo $customerid;?>" style="color:blue;border-bottom:3px;border-bottom-style:dashed;"><?php echo $customerid;?></a></td>
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
        <td><?php echo "Worth: ".$worth; ?> pesos</td>
      </tr>
      <tr>
        <td><?php echo "Address: ".$address; ?></td>
      </tr>
      <tr>
        <td><?php echo "Date completed: ".$drecieve;?></td>
      </tr>
        </table>
          <?php }  }?>
    </div>
  </body>
</html>