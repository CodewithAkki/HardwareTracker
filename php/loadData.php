<?php
$selected = $_POST['column'];
if(isset($selected)){
require('./connect.php');
$conn = conectivity();

$sql = "select * from HardwareInfo";
$stmt = sqlsrv_query($conn, $sql);
$output="";
$output="<select id='result' class='mainselection'>";
$res=array();
while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $res[] =  $obj[$selected]; 
}
$resultant=array_unique($res);
$output.="<option value={$selected}>{$selected}</option>";
foreach($resultant as $value){
    $output.="<option value={$value}>{$value}</option>";
}
$output.="</select>";
sqlsrv_close($conn);
echo $output;
}else{
    sqlsrv_close($conn);
    echo "<h1>not found</h1>";
}
?>