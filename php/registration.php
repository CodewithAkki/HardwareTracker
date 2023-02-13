<?php

if (isset($_POST["submit"])) {
print_r($_POST);
require "connection_mssql.php";

$conn=conectivity();

$username = $_POST['username'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$isAdmin = 0;

if($password==$confirmpassword){

$sql="select * from users where userName = ?";
$stmt=sqlsrv_query($conn,$sql,array($username));
$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
print_r($obj);
if(isset($obj)){
   ?>
   <script>
    alert('username already exists')
    </script>
   <?php
  # header("Location: http://localhost/HardwareFinder/register.html");
}

$sql="select * from users where email = ?";
$stmt=sqlsrv_query($conn,$sql,array($email));
$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
print_r($obj);

if(isset($obj)){
   ?>
   <script>
    alert('email already exists')
   </script>
   
   <?php
     #header("Location: http://localhost/HardwareFinder/register.html");
}

//$sql="insert into users (mobileNo,email,password,fullName,userName,isAdmin) values(?,?,?,?,?,?); ";
//$stmt=sqlsrv_query($conn,$sql,array($phone,$email,$password,$fullname,$username,$isAdmin));


if($stmt==false){
           // print_r(sqlsrv_errors(), true);
    header("Location: http://localhost/HardwareFinder/error.html");
}

//header("Location: http://localhost/HardwareFinder/sign%20in.html");
   
}else {
        ?>
        <script>
            confirm("please check password");
        </script>
        <?php     
    }

}else{
    header("Location: http://localhost/HardwareFinder/error.html");
}

?>