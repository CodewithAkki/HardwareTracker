<?php

session_start();

    require('./php/connection_mssql.php');
    $conn = conectivity();
    if (isset($_GET['request'])) {
        
        if(isset( $_GET['search'])){
            $search = $_GET['search'];
        }
        $filter = $_GET['filter'];
       if ($filter == 'PCName'){
        $search=mb_strtoupper($search);
       }

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
            margin: 70px 0;
            font-size: 0.8em;
        
            border-radius: 5px 5px 0 0;
            overflow-y: scroll;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.505);
           
            width: 100%;
            height: 350px;
            position: absolute;
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
    
    font-weight: bold;

    color: black;
    margin-right:150px ;

}
.submitbutton{
    font-family: Roboto;
    position: fixed;
    left: 55%;
    font-weight: bold;
    margin-top: 30px;
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
    margin-top: 30px;
    color: black;
    margin-right:150px ;
}
.filterusername{
    font-family: Roboto;
    position: fixed;
    margin-top: 50px
}


    </style>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</head>
<body background="#F8F4EA">
  <div class="home">
<div class="mainhome">

</div>
  <div class="leftmenu">
    <div class="heighlightmenuHome"></div>
    <ul class = "undefindedlist">
      <a href="http://localhost/HardwareFinder/index.php"><li class="home">Home</li></a>
      <a href="http://localhost/HardwareFinder/sign_in.html"><li>Sign in</li></a>
      <a href="http://localhost/HardwareFinder/contact_us.html"><li>Contact us</li></a>
      <a href="http://localhost/HardwareFinder/abouts.html"><li>About</li></a>
    </ul>
  </div>
  <nav>
  <img class="nav" src="./images/Group 3.png" alt="">
  </nav> 

  <div class="table-content">
  <script>
function change(){
   
    document.getElementById("filter").submit()
}
</script>
  <form action="" id="myform" method="get">
     <p class="filterLabel">filter</p>
<select name="filter" id="filter" class="filter" onchange="change()">
    <option value="SerialNumber"<?php if(isset($filter)){ if($filter=="SerialNumber"){echo"selected";}}?> >Serial No</option>
    <option value="PCName"    <?php if(isset($filter)){if($filter=="PCName"){echo"selected";}}?>   >PC Name</option>
    <option value="HardwareName" <?php if(isset($filter)){ if($filter=="HardwareName"){echo"selected";}}?> >Hardware Name</option>
    <option value="Licenses"   <?php if(isset($filter)){ if($filter=="Licenses"){echo"selected";}}?>  >Licenses</option>
</select>



<input type="submit" value="submit" name="request" class="submitbutton"/>
<input type="submit" value="clear" name="clear" class="clearbutton"/>
<?php

    $sql = "select * from HardwareInfo";
    $stmt = sqlsrv_query($conn, $sql);
    while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if(isset($filter)){    
        $usr[]=$obj[$filter];
        }
    }
    if(isset($filter)){ 
    $usr=array_unique($usr);
    echo '<select name="search" id="username" class="searchLabel" >';
    foreach($usr as $value ){
        echo"<script>";
        echo"alert($value);";
        echo"</script>";
        echo '<option value='. strip_tags($value).'>'. strip_tags($value).'</option>';
    }
    echo '</select>';
}
?>
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

