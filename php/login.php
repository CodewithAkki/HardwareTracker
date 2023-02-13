<!--
    popups for login and fail is remaing
-->



<?php

if(isset($_POST["submit"])){
//    print_r($_POST);
require "connection_mssql.php";

$conn=conectivity();
$username = $_POST['username'];
$password = $_POST['password'];

session_start();
$_SESSION['username']=$username;

$sql="select * from users where userName = ? ";
$stmt=sqlsrv_query($conn,$sql,array($username));

if($stmt == false){
    header("Location: http://localhost/HardwareFinder/error.html");
}

$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

$verify = password_verify($password, $obj['password']);
if($verify){
    if (isset($obj)) {
        if($obj['isAdmin']){
       echo"  <script> ";
       echo " alert('user login successfully');";
       echo "window.location.href='http://localhost/HardwareFinder/php/searchHardware.php'";
       echo " </script> ";
        }else{
            echo"  <script> ";
            echo " alert('user login successfully');";
            echo "window.location.href='http://localhost/HardwareFinder/php/adminSearchHardware.php'";
            echo " </script> ";
        }
    }
    } else {

        ?>
   
    <script>
        alert('user not found');
        window.location.href='http://localhost/HardwareFinder/sign%20in.html';
    </script>
        
        
        <?php
         //header("Location: http://localhost/HardwareFinder/sign%20in.html");
    }


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);



}else{
    header("Location: http://localhost/HardwareFinder/error.html");
}
?>