<?php

if(isset($_POST["submitAdmin"])){
    
    $adminEmail = $_POST["adminEmail"];
    $adminPwd = $_POST["adminPwd"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if(emptyAdminInputLogin($adminEmail, $adminPwd) !== false){
        header("location: ../REBND_AdminLogin.php?adminerror=emptyinput");
        exit();
    }
    
    adminLogin($pdo, $adminEmail, $adminPwd);
}
else {
    header("location: ..REBND_Adminlogin.php");
    exit();
}