

<?php

if (isset($_POST["submit"])) {
  print_r($_POST);
  require "./php/connection_mssql.php";

  $conn = conectivity();
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];

  $usernamemessage=$emailmessage=$phonemessage=$fullnamemessage=$passwordmessage=null;
  
  $passwordCheck="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/i";
  $phoneCheck = "/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/i";



  if ($password == $confirmpassword) {
    $name=str_replace(' ', '', $fullname);
    if (Ctype_alpha(trim($name))) {
      if(preg_match($passwordCheck, $password)) {
        if (preg_match($phoneCheck, $phone)) {
          
          $sql = "select * from users where userName = ?";
          $stmt = sqlsrv_query($conn, $sql, array($username));
          $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
          print_r($obj);
          if (isset($obj)) {
            $usernamemessage = 'username already exists';
            ?>
   <script>
    alert('username already exists')
    </script>
   <?php
            # header("Location: http://localhost/HardwareFinder/register.html");
          }

          $sql = "select * from users where email = ?";
          $stmt = sqlsrv_query($conn, $sql, array($email));
          $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
          print_r($obj);

          if (isset($obj)) {
            $emailmessage = "email already exists";
            ?>
   <script>
    alert('email already exists')
   </script>
  
   <?php
            #header("Location: http://localhost/HardwareFinder/register.html");
          }

          $sql = "select * from users where mobileNo = ?";
          $stmt = sqlsrv_query($conn, $sql, array($phone));
          $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
          print_r($obj);

          if (isset($obj)) {
            $emailmessage = "phone no already exists";
            ?>
   <script>
    alert('phone no already exists');
   </script>
  
   <?php
            #header("Location: http://localhost/HardwareFinder/register.html");
          }
          $stmt = false;
          if(!(isset($emailmessage)||isset($phonemessage)||isset($fullnamemessage)||isset($passwordmessage)||isset($usernamemessage)) == true){
            $sql="insert into users (mobileNo,email,password,fullName,userName,isAdmin) values(?,?,?,?,?,1); ";
            $stmt=sqlsrv_query($conn,$sql,array($phone,$email,password_hash($password, PASSWORD_DEFAULT),$fullname,$username,$isAdmin));
            
          if($stmt == false){
            ?>
            <script>
              alert("user registration failed ");
              </script>
            <?php
         }if(sqlsrv_errors()){
           ?>
           <script>
             alert("user registration failed");
             </script>
           <?php
         } else {
           ?>
           <script>
             alert("user registered successfully");
             window.location.href='http://localhost/HardwareFinder/sign%20in.html';
             </script>
           <?php
            
         }

          }
         



        } else {
          $phonemessage = "please enter valid phone number";
        }

      } else {
        $passwordmessage = "please enter strong password";
      }
    } else {
      $fullnamemessage = "please enter full name ";
    }
  } else {
    $passwordmessage = "password is not matching";
  ?>
  <script>
    alert("password is not matching");
  </script>
  <?php
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
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body background="#F8F4EA">

  <div class="leftmenu">
    <div class="heighlightmenuSignin"></div>
    <ul class = "undefindedlist">
      <a href="http://localhost/HardwareFinder/index.php"><li class="home">Home</li></a>
      <a href="http://localhost/HardwareFinder/sign_in.html"><li>Sign in</li></a>
      <a href="http://localhost/HardwareFinder/contact_us.html"><li>Contact us</li></a>
      <a href="http://localhost/HardwareFinder/abouts.html"><li>About</li></a>
    </ul>
    </div>


  <nav>
  <img class="nav" src="./images/Group 3.png" alt="">
  </nav>   
  <div class ="login">
    <center>
      <div class="wrapper">
        <form action="" method="post">
          <h1 class="signin">Sign Up</h1>
          <div class="forms">
            <label><?php if (isset($usernamemessage)) {
              echo "<style>#usernamefield{border: 2px solid red;}</style>";}?></label>
            <input type="text" name="username" placeholder="Username"  class="username" id="usernamefield" autofocus required/><br>
          </br>
          <label><?php if (isset($fullnamemessage)) {
              echo "<style>#fullname{border: 2px solid red;}</style>";}?></label>
          <input type="text" name="fullname" placeholder="Fullname" id="fullname" class="username"  autofocus required/><br>
        </br>
        <label><?php if (isset($emailmessage)) {
              echo "<style>#email{border: 2px solid red;}</style>";}?></label>
         <input type="text" name="email" placeholder="Email" class="username" id="email" autofocus required/><br>
        </br>
        <label><?php if (isset($phonemessage)) {
              echo "<style>#phone{border: 2px solid red;}</style>";}?></label>
        <input type="tel" id="phone" name="phone" id="phone" placeholder="mobile no" class="username">
    </br></br>
    <label><?php if (isset($passwordmessage)) {
              echo "<style>#password{border: 2px solid red;}</style>";}?></label>
          <input type="password" name="password" placeholder="Password" class="password" id="password" required/></br></br>
          <input type="password" name="confirmpassword" placeholder="Confirm Password" id="password" class="password" required/></br></br>
          </br>
    <div class="buttons">
             
<center><input type="submit" name="submit"  value="Register" class="loginButton"></center>
</div>
          </div>
        </form>
        </p>
      </div>
    </center>
  </div>  
</body>
</html>









