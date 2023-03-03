<?php

require('./connect.php');
$conn = conectivity();
$pin=$_POST['pin'];

//print_r($_POST);

$sql="select * from pins where pin = '{$pin}' ";
//echo $sql;
$stmt=sqlsrv_query($conn,$sql) or die( print(0));



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



if($obj){
    sqlsrv_close($conn);
    echo 1;
}else{
    sqlsrv_close($conn);
    echo 0;
}


?>