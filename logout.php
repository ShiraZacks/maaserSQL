<?php
    session_start();
    // Destroy session clear array.
    session_destroy();
    $_SESSION = array();
    // Redirecting To login
    header("Location: login.php");
    exit;
?>
