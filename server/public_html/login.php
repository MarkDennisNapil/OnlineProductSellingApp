<?php
include 'db.php';
session_start();

if(isset($_POST['login'])){

   $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
   $password = mysqli_real_escape_string($conn, md5($_POST['txtpassword']));

   $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['id'] = $row['id'];
      $_SESSION['email']=$row['email'];
      $urole = $row['role'];
      $_SESSION['role'] = $row['role'];
    if($urole=="customer"){
        echo "<script> location.href='index.php'; </script>";
    }
    elseif ($urole=="rider") {
        echo "<script> location.href='delridepage.php'; </script>";
    }
    elseif ($urole=="admin"){
        echo "<script> location.href='adminpage.php'; </script>";
    }
    elseif ($urole=="master"){
        echo "<script> location.href='index.php'; </script>";
    }
    else{
      echo "No role";
    }
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
  <link rel="stylesheet" href="css/style.css">
      <script src="remove.js"></script>
</head>
<body>
  <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
  <div class="login-center" style="border-radius:3px;margin-top:50px;">
   <form action="login.php" method="post">
    <fieldset class="login-field">
      <label class="left-label">Email</label><br>
      <input type="email" name="txtemail" id="txtemail" placeholder="Email here..." style="padding: 7px;" required><br>
      <label class="left-label">Password</label><br>
      <input type="password" name="txtpassword" id="txtpassword" style="padding: 7px;" placeholder="Password here..."><br>
      <input type="submit" name="login" id="btn-login" value="Login" required><br>
    </fieldset>
   </form>
   <a href="register.php" class="reg-link" style="color: white;">Register</a>
  </div>
</body>
</html>