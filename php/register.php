<?php

require('./connect.php');
$conn = conectivity();
$email=$_POST['email'];
$pass=$_POST['pass'];
$regusername=$_POST['regusername'];
$phone=$_POST['phone'];
$fullname=$_POST['fullname'];
//print_r( $_POST );





$sql=  "select * from users where userName = '{$regusername}'";
//echo $sql;
$stmt=sqlsrv_query($conn,$sql) or die(print( 0));



if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }
}
$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ;



if($obj){
    sqlsrv_close($conn);
echo "username";
}else{
   // sqlsrv_close($conn);
   $sql="select * from users where email = '{$email}' ";
   $stmt=sqlsrv_query($conn,$sql) or die(print(0));
   $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
   if($obj){
    sqlsrv_close($conn);
    echo "email";
   }else{

    $sql="select * from users where mobileNo = '{$phone}' ";
    $stmt=sqlsrv_query($conn,$sql) or die( print(0));
    $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ;
    if($obj){
     sqlsrv_close($conn);
     echo "phone";
    }else{
            $pass= password_hash($pass, PASSWORD_DEFAULT);
            $sql = "insert into users (mobileNo,email,password,fullName,userName,isAdmin) values('{$phone}','{$email}','{$pass}','{$fullname}','{$regusername}',0);";
            $stmt=sqlsrv_query($conn,$sql) or die( print(0));
            sqlsrv_close($conn);
            echo 1;

    }

   }
    


}





?>