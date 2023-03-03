<?php

require('./connect.php');
$conn = conectivity();
$term=$_POST['term'];
$output="";
if(isset($term)){
$sql = "select * from HardwareInfo where Licenses like '%{$term}%';";
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
        
</tr><div ><tbody class='tablebody' >";
$i=0;
while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$i=$i+1;
$output.="<tr style='height:30px;'><td>{$i}</td><td>{$obj['UserName']}</td><td>{$obj['PCName']}</td><td>{$obj['HardwareName']}</td><td >{$obj['SerialNumber']}</td><td>{$obj['debugger_serial_number']}</td><td>{$obj['debugger_Cable_serial_number']}</td><td>{$obj['Licenses']}</td><td>{$obj['Licenses_valid_upto']}</td></tr>";

}
$output.="</div></tbody></table>";
sqlsrv_close($conn);
echo($output);
}else{
echo "<h1>data not found</h1>";

}



?>