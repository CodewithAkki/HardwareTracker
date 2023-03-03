<?php

require('./connect.php');
$conn = conectivity();
$SerialNumber=$_POST['SerialNumber'];
$PCName=$_POST['PCName'];
$UserName=$_POST['UserName'];
$HardwareName=$_POST['HardwareName'];
$debugger_serial_number=$_POST['debugger_serial_number'];
$debugger_Cable_serial_number=$_POST['debugger_Cable_serial_number'];
$Licenses=$_POST['Licenses'];
$Licenses_valid_upto=$_POST['Licenses_valid_upto'];


$sql="insert into HardwareInfo(SerialNumber,PCName,UserName,HardwareName,debugger_serial_number,debugger_Cable_serial_number,Licenses,Licenses_valid_upto) 
            values('{$SerialNumber}','{$PCName}','{$UserName}','{$HardwareName}','{$debugger_serial_number}','{$debugger_Cable_serial_number}','{$Licenses}','{$Licenses_valid_upto}')";

$stmt = sqlsrv_query($conn, $sql);

if($stmt){
    sqlsrv_close($conn);
    echo 1;
}else{
    sqlsrv_close($conn);
    echo 0;
}





?>