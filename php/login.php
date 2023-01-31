


<?php

if(isset($_POST["submit"])){
  
require "connection_mssql.php";

$conn=conectivity();
$fullname

$sql="select * from users where ";
$stmt=sqlsrv_query($conn,$sql);

if($stmt == false){
    echo sqlsrv_errors();
}
 $i=0;
while($obj = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
    $i++;
    echo $i . $obj['Licenses'].'<br/>';
}
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);



}else{
    header("Location: http://127.0.0.1:5500/error.html");
}
?>