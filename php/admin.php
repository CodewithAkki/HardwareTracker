<?php
session_start();

function titlGive($title){
    if($title=='-'){
        return 'Licenses_Hardwarebased_older_device';
    }
    return "";
}




if(isset($_SESSION['username'])){

require('./connect.php');
$conn = conectivity();

$sql = "select * from HardwareInfo";
$stmt = sqlsrv_query($conn, $sql);

    $output="
<table border='1' width='100%' cellspacing='0' cellpadding='10px' class='content' id='tabledev'> 
<tr class='tableheading'>
<th>Sr.no</th>
<th>Username</th>
<th >PC Name</th>
<th>Vector Hardware Name</th>
<th >Vector Serial No</th>
<th> Debugger Serial Number </th>
<th> Debugger Cable Serial number </th>
<th> Licenses</th>
<th> Licenses valid Upto </th>
<th>Date</th>
<th>Time</th>
<th></th>
<th></th>


        
</tr><div ><tbody class='tablebody' >";
$i=0;
while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$i=$i+1;
    $output.="<tr id='rowstable' style='height:30px; '>
    

    <td>{$i}</td>
    <td>{$obj['UserName']}</td>
    <td>{$obj['PCName']}</td>
    <td>{$obj['HardwareName']}</td>
    <td>{$obj['SerialNumber']}</td>
    <td >{$obj['debugger_serial_number']}</td>
    <td title='if - device is not debugger'>{$obj['debugger_Cable_serial_number']}</td>
    <td>{$obj['Licenses']}</td>
    <td title=".titlGive($obj['Licenses_valid_upto'])." > {$obj['Licenses_valid_upto']}</td>
    <td>{$obj['Date']}</td>
    <td>{$obj['time']}</td>
    
    
   
    
    
    <td><button class='update' id='updated' name='update' value={$obj['RowID']} ><i class='fa-solid fa-file-pen'></i></button></td>
    <td><button class='delete' id='deleted' name='delete' value={$obj['RowID']}  ><i class='fa-solid fa-trash-can'></i></button></td>
    
    </tr>
    
    ";
}
$output.="</div></tbody></table>";
sqlsrv_close($conn);
echo($output);
}else{
   echo -1;

}
?>