<?php
session_start();
if ($_SESSION['username']) {

  require('connection_mssql.php');
  $conn = conectivity();

  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];
  if (isset($password) && isset($cpassword)) {
    if ($password == $cpassword) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $username=$_SESSION['username'];
      $sql = "update users set password = '$password' where userName='$username'";
      $stmt = sqlsrv_query($conn, $sql);
      echo "<script>";
      echo "alert('password has been changed');";
      echo " window.location.href='http://localhost/HardwareFinder/sign_in.html';";
      echo "</script>";

      
    }
  }





  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body background="#F8F4EA" >

  <nav>
    <img class="nav" src="../images/Top.png" alt="">
  </nav>
  <div class ="login">
    <center>
      <div class="wrapper">
        <form action="./php/login.php" method="post">
          <h1 class="signin">Change password</h1>
          <div class="forms">
        
          <input type="password" name="password" placeholder="password" class="cpassword" autofocus/><br>
          <i class="fa fa-user"></i></br>
          <input type="password" name="cpassword" placeholder="confirm-Password" class="cmpassword"/></br></br>
          <i class="fa fa-key"></i>
        
    <div class="buttons">      
<input type="submit" value="change password" name="submit" class="changepassword">
</div>
          </div>
        </form>
        </p>
      </div>
    </center>
  </div>   
</body>
</html>
<?php

}

?>