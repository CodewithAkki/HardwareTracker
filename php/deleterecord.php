<?php

require('./connect.php');
$conn = conectivity();
$rowid=$_POST['RowID'];

$sql ="delete from HardwareInfo where RowID ={$rowid}";
$stmt = sqlsrv_query($conn, $sql);
if($stmt){
    sqlsrv_close($conn);
    echo 1;
}else{
    sqlsrv_close($conn);
    echo 0;
}





?>