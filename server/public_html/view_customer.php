    <?php 
    include 'db.php';
    
    $custid=$_GET['customer_id'];
?>
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
    <a href="adminpage.php" style="font-size:15pt;font-weight:bold;background-color:teal;color:black;padding-left:5px;padding-right:5px;"><</a>
    <?php
        $getcust = mysqli_query($conn,"SELECT * FROM users WHERE id=$custid");
    
			while($row=mysqli_fetch_array($getcust)){
				$profilepic=$row['profilepic'];
				$fname=$row['fname'];
				$lname=$row['lname'];
				$sex=$row['sex'];
				$phone=$row['phone'];
				$email=$row['email'];
				$txtaddress=$row['txtaddress'];
				?>
    <div class="cust-profile" style="width:100%;">
    <table border="0" class="v-cust-prof" style="padding:7px;">
      <tr>
        <td colspan="2"><img src="<?php echo $profilepic;?>" style="width:100%;height:auto;"></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><?php echo $fname." ".$lname; ?></td>
      </tr>
      <tr>
        <td>Gender:</td>
        <td><?php echo $sex; ?></td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td><?php echo $phone; ?></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><?php echo $email; ?></td>
      </tr>
      <tr>
        <td>address:</td>
        <td><?php echo $txtaddress; ?></td>
      </tr>
   <?  }  
 ?>
     <?php
    $sql = "SELECT  COUNT(order_id) FROM orders WHERE customer_id=$custid AND order_status='paid'";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)){
    ?>
    <tr>
        <td>Total Orders Made:</td>
        <td><h3 style="color: blue;"><?php echo $row['COUNT(order_id)']; } ?> paid orders</h3></td>
      </tr>
        </table>
  </div>
  </body>
  </html>