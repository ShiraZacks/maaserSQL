<?php
session_start();
if(!isset($_SESSION["success"])){
    header('location: login.php');
}
?>