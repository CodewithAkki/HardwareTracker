<?php

session_start();

    require('./php/connection_mssql.php');
    $conn = conectivity();
    if (isset($_GET['request'])) {
        
        $search = $_GET['search'];
        $filter = $_GET['filter'];
       

    }
   
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./styles/index.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&family=Pacifico&display=swap'); 
        .table-content{
            width: 80%;
            height: 450px;
            position: fixed;
            right: 3%;
          }

        .content-table{
        
            color: white;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.8em;
           
            border-radius: 5px 5px 0 0;
            overflow-y: scroll;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.505);
           
            width: 80%;
            height: 350px;
            position: fixed;
            right: 3%;
         
            
        }
        .content-table th{
          position: sticky;
          width: 150px;
          
        }
        .content-table thead tr{

            background-color: #1D5B99;
            text-align: center;
            font-weight: bold;
        }
        .content-table td{
          color: black;
           width: 200px;
           text-align: center;
           
        }
   
        .content-table th,
        .content-table td
        {
            font-family:Poppins ;
            padding: 12px 15px;
            
            
        }
        .content-table tbody{
          font-size: 0.8em;
          width: 80%;
          height: 300px;
          position: fixed;
          display: block;
          overflow-y: scroll ;
          
   
        }
        .content-table tbody tr{
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even){
            background-color: #f3f3f3f3;
        } 

.searchLabel{
    font-family: Roboto;
    position: fixed;
    left: 35%;
    font-weight:300;
    margin-top: -3px;
    border-radius: 50px;
    padding-left: 20px;
    outline: none;
    color: black;
    margin-right:150px ;

}
.submitbutton{
    font-family: Roboto;
    position: fixed;
    left: 55%;
    font-weight: bold;
    margin-top: -3px;
    color: black;
    margin-right:150px ;
}
.filterLabel{
    font-family: Roboto;
    position: fixed;
    left: 20%;
    font-weight: bold;
    margin-top: -20px;
    color: black;
    margin-right:150px ;
}
.filter{
    font-family: Roboto;
    position: fixed;
    left: 20%;
}
.clearbutton{
    font-family: Roboto;
    position: fixed;
    left: 60%;
    font-weight: bold;
    margin-top: -3px;
    color: black;
    margin-right:150px ;
}

    </style>
</head>
<body background="#F8F4EA">
  <div class="home">
<div class="mainhome">

</div>
  <div class="leftmenu">
    <div class="heighlightmenuHome"></div>
    <ul class = "undefindedlist">
      <a href="http://localhost/HardwareFinder/index.php"><li class="home">Home</li></a>
      <a href="http://localhost/HardwareFinder/sign%20in.html"><li>Sign in</li></a>
      <a href="http://localhost/HardwareFinder/Contact%20us.html"><li>Contact us</li></a>
      <a href="http://localhost/HardwareFinder/about.html"><li>About</li></a>
    </ul>
  </div>
  <nav>
    <img class="nav" src="./images/Top.png" alt="">
  </nav> 

  <div class="table-content">

  <form action="" method="get">
     <p class="filterLabel">filter</p>
     <select name="filter" id="filter" class="filter">
    <option value="SerialNumber">Serial No</option>
    <option value="PCName">PC Name</option>
    <option value="UserName">Username</option>
    <option value="HardwareName">Hardware Name</option>
    <option value="Licenses">Licenses</option>
</select>

<input type="text" class="searchLabel" name="search"/>
<input type="submit" value="submit" name="request" class="submitbutton"/>
<input type="submit" value="clear" name="clear" class="clearbutton"/>
</form>
 
    <table class="content-table">
        <thead >
        <tr>
            <th >Serial No</th>
            <th >PC Name</th>
            <th>Username</th>
            <th>Hardware Name</th>
            <th> Licenses</th>
        </tr>
    </thead>
    <tbody class="content-body">
     <!--  <p> <?php if (isset($_GET['request'])) {
           echo $search, $filter;
       } ?> </p>-->
    <?php
    if (isset($search) == true && isset($filter) == true) {
        if ($search !== "" && $filter !== "") {
            $sql = "select * from HardwareInfo where" . " " . $filter . "=" . "'$search'";
            try {
                $stmt = sqlsrv_query($conn, $sql);
                while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    ?>
  
      <?php
                          echo "<tr>";
                          echo "<td>" . $obj['SerialNumber'] . "</td>";
                          echo "<td>" . $obj['PCName'] . "</td>";
                          echo "<td>" . $obj['UserName'] . "</td>";
                          echo "<td>" . $obj['HardwareName'] . "</td>";
                          echo "<td>" . $obj['Licenses'] . "</td>";
                          echo " </tr> ";
                }
            } catch (Error $e) {
                echo "<script>";
                echo "alert('please check the Entered value')";
                echo "</script>";

                echo "window.location.href='http://localhost/HardwareFinder/index.php'";
            }
            if ($stmt == false) {
                header("Location: http://localhost/HardwareFinder/error.html");
             }
        } else {
            
            $sql = "select * from HardwareInfo ";
            $stmt = sqlsrv_query($conn, $sql);
            while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                ?>
  
      <?php
                          echo "<tr>";
                          echo "<td>" . $obj['SerialNumber'] . "</td>";
                          echo "<td>" . $obj['PCName'] . "</td>";
                          echo "<td>" . $obj['UserName'] . "</td>";
                          echo "<td>" . $obj['HardwareName'] . "</td>";
                          echo "<td>" . $obj['Licenses'] . "</td>";
                          echo " </tr> ";
            }
            if ($stmt == false) {
                header("Location: http://localhost/HardwareFinder/error.html");
            }
        }
        } else if (isset($search) == false && isset($filter) == false) {

            $sql = "select * from HardwareInfo ";
            $stmt = sqlsrv_query($conn, $sql);
            while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                ?>
  
      <?php
                          echo "<tr>";
                          echo "<td>" . $obj['SerialNumber'] . "</td>";
                          echo "<td>" . $obj['PCName'] . "</td>";
                          echo "<td>" . $obj['UserName'] . "</td>";
                          echo "<td>" . $obj['HardwareName'] . "</td>";
                          echo "<td>" . $obj['Licenses'] . "</td>";
                          echo " </tr> ";
            }
            if ($stmt == false) {
                header("Location: http://localhost/HardwareFinder/error.html");
            }
        
        }




    
    flush(); // Flush the buffer
    ob_flush();

      ?> 
    </tbody>
    </table>


  </div> 
  </div> 
</body>
</html>

