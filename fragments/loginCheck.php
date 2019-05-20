<?php
    session_start();
    require_once __DIR__.'/../classes/DatabaseHandler.php';
    
    if(!isset($_SESSION['userLoggedIn'])){
        header("location:login.php");
        exit;
    }
?>