<?php
function conectivity(){
$db_server_name = "PU2S0017\SQLEXPRESS2017"; 
$db_user_name = "hwtracker_db";
$db_name = "Hardware_Tracking";
$db_password = "Test@123";

    $connectionInfo = [
        "Database" => $db_name,
        "Uid"=>$db_user_name,
        "PWD"=>$db_password
    ];

    $conn=sqlsrv_connect($db_server_name,$connectionInfo);



    $sql="IF NOT EXISTS(SELECT * FROM sysobjects  WHERE name='users' AND xtype='U')
        create table users(
            userId int IDENTITY(1,1) primary key,
            mobileNo varchar(15)  null,
            email varchar(200) unique not null,
            password varchar(200) not null,
            isAdmin BIT not null,
            fullName varchar(200) not null,
            userName varchar(100) unique not null
        )";



    if($conn){    
        $stmt=sqlsrv_query($conn,$sql);
        if($stmt == false){
            echo sqlsrv_errors();
        }
        return $conn;
    }
    else{return die(print_r(sqlsrv_errors(),true));}

    



}

?>