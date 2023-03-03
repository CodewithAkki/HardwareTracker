<?php
session_start();
if(isset($_SESSION['username'])){

require('./connect.php');
$conn = conectivity();
$term=$_POST['term'];
$output="";
$sql ="";
$sql = "select * from HardwareInfo where Licenses like '%{$term}%';";

if(isset($term)){

$stmt = sqlsrv_query($conn, $sql);

    $output="
<table border='1' width='100%' cellspacing='0' cellpadding='10px' class='content'> 
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
        <th> Date </th>
        <th> time </th>
        <th> </th>
        <th> </th>
        
</tr><div ><tbody class='tablebody' >";
$i=0;
while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$i=$i+1;
    $output.="<tr style='height:30px;'>
   
    <td>{$i}</td>
    <td>{$obj['UserName']}</td>
    <td>{$obj['PCName']}</td>
    <td>{$obj['HardwareName']}</td>
    <td>{$obj['SerialNumber']}</td>
    <td>{$obj['debugger_serial_number']}</td>
    <td>{$obj['debugger_Cable_serial_number']}</td>
    <td>{$obj['Licenses']}</td>
    <td>{$obj['Licenses_valid_upto']}</td>
    <td>{$obj['Date']}</td>
    <td>{$obj['time']}</td>
  
    
   
    
    
   
    
    
    <td><button class='update' id='updated' name='update' value={$obj['RowID']} ><i class='fa-solid fa-file-pen'></i>  </button></td>
    <td><button class='delete' id='deleted' name='delete' value={$obj['RowID']}  ><i class='fa-solid fa-trash-can'></i></button></td>
    
    </tr>
    
    ";
    
}
$output.="</div></tbody></table>";
sqlsrv_close($conn);
echo($output);
}else{
echo "<h1>data not found</h1>";

}
}



?>