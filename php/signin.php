<?php

require('./connect.php');
$conn = conectivity();
$username=$_POST['username'];
$password=$_POST['password'];
//print_r($_POST);

$sql="select * from users where userName = '{$username}' ";
//echo $sql;
$stmt=sqlsrv_query($conn,$sql) or die( print_r( sqlsrv_errors(), true));



if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }
}
$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) or die(print(0));

$verify = password_verify(strval($password), $obj['password']);

if($verify){
    session_start();
    $_SESSION['username']=$username;
    
    sqlsrv_close($conn);
echo 1;
}else{
    sqlsrv_close($conn);
    echo 0;
}


?>