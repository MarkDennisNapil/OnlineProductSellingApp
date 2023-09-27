<?php
include 'db.php';
session_start();

if(isset($_POST['login'])){

   $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
   $password = mysqli_real_escape_string($conn, md5($_POST['txtpassword']));

   $select = mysqli_query($conn, "SELECT rider_id,email,password FROM riders WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['rider_id'] = $row['rider_id'];
      $_SESSION['email']=$row['email'];
         echo "<script> location.href='delridepage.php'; </script>";
   }
   else{
      $message[] = 'incorrect password or email!';
   }

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
  <div class="login-center">
    <form action="delride_login.php" method="post">
      <fieldset class="login-field">
        <legend>Delivery Rider Login</legend>
        <center>
        <input type="email" name="txtemail" style="padding:7px;width:350px;" id="txtemail" placeholder="Email@examplecom..." required><br>
        <input type="password" name="txtpassword" id="txtpassword" style="padding:7px;width:350px;" placeholder="Password here..."><br>
        <input type="submit" name="login" id="btn-login" style="background-color: orange;" value="Login" required><br>
        </center>
      </fieldset>
    </form>
    
  </div>

</body>
</html>