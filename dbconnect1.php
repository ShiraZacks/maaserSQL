<?php
    $serverName = "localhost";  
    $userName = "root";  //default user name
    $password = "";
    $DBName = "maaser";  //name of database in mysql
    $conn = mysqli_connect($serverName,$userName,$password,$DBName);
    if(mysqli_connect_errno()){
        echo "failed to connct to MySQL" . mysqli_connect_error();
        exit();
    }
?>