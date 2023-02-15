<?php
if(isset($_GET['submit'])){
$username=$_GET['email'];

    if (isset($email)) {
      
$sql="select * from users where userName = ? ";
$stmt=sqlsrv_query($conn,$sql,array($email));

if($stmt == false){
    header("Location: http://localhost/HardwareFinder/error.html");
}

    $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
   $emailtrue = $obj['email'];
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body background="#F8F4EA" >


  <nav>
  <img class="nav" src="../images/Group 3.png" alt="">
  </nav>
  <div class ="login">
    <center>
      <div class="wrapper">
        <form action=" " method="get">
          <h1 class="signin">Sign in</h1>
          <div class="forms">
       
          <input type="text" name="email" placeholder="Enter email" class="username" autofocus/><br>
          <i class="fa fa-user"></i></br>
    <div class="buttons">      
<input type="submit" value="submit" name="submit" class="loginButton">
</div>
          </div>
        </form>
        </p>
      </div>
    </center>
  </div>
   
</body>
</html>

<?php

}
}

?>