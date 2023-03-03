<?php

require('./connect.php');
$conn = conectivity();
$device=$_POST['device'];
$sql = "select count(*) from HardwareInfo where Licenses like '%{$device}%';";
$stmt = sqlsrv_query($conn, $sql);
$count=sqlsrv_num_rows($stmt);
$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
if($obj[0]){
    echo $obj[0];
}else{
    echo 0;
}


?>