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
$RowID=$_POST['RowID'];

$sql ="update HardwareInfo set SerialNumber='{$SerialNumber}' , PCName='{$PCName}' , UserName='{$UserName}' , HardwareName='{$HardwareName}',debugger_serial_number='{$debugger_serial_number}' ,debugger_Cable_serial_number='{$debugger_Cable_serial_number}', Licenses='{$Licenses}',Licenses_valid_upto='{$Licenses_valid_upto}' where RowID='{$RowID}'";
$stmt = sqlsrv_query($conn, $sql);
if($stmt){
    sqlsrv_close($conn);
    echo 1;
}else{
    sqlsrv_close($conn);
    echo 0;
}





?>