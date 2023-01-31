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
            mobileNo varchar(15) not null,
            email varchar(200) not null,
            password varchar(200) not null,
            isAdmin BIT not null,
            fullName varchar(200) not null
        )";

    $sql2 = "
        IF NOT EXISTS(SELECT * FROM sysobjects  WHERE name='users' AND xtype='U')
        CREATE TABLE [dbo].[HardwareInfo](
        [RowID] [int] IDENTITY(1,1) NOT NULL,
        [SerialNumber] [nvarchar](50) NULL,
        [PCName] [nvarchar](50) NULL,
        [UserName] [char](30) NULL,
        [HardwareName] [nvarchar](max) NULL,
        [NoOfLicenses] [nvarchar](50) NULL,
        [Licenses] [nvarchar](max) NULL
    ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]"; 

    if($conn){    
        $stmt=sqlsrv_query($conn,$sql);
        if($stmt == false){
            echo sqlsrv_errors();
        }
        $stmt=sqlsrv_query($conn,$sql2);
        if($stmt == false){
            echo sqlsrv_errors();
        }
        return $conn;
    }
    else{return die(print_r(sqlsrv_errors(),true));}

    



}

?>