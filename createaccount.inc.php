<?php

if(isset($_POST["create"])){

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $passwordrepeat = $_POST["passwordrepeat"];
    
    require_once 'functions.php';
    
    if(emptyInputCreateAccount($fname, $lname, $email, $pwd, $passwordrepeat) !== false){
        header("location: ../createaccount.php?error=emptyinput");
        exit();
    }
    if(invalidfname($fname) !== false){
        header("location: ../createaccount.php?error=invalidfirstname");
        exit();
    }
    if(invalidlname($lname) !== false){
        header("location: ../createaccount.php?error=invalidlaststname");
        exit();
    }
    if(invalidemail($email) !== false){
        header("location: ../createaccount.php?error=invalidemail");
        exit();
    }
    if(passwordmatch($pwd, $passwordrepeat) !== false){
        header("location: ../createaccount.php?error=passwordsdontmatch");
        exit();
    }
    if(emailexists($connect, $email) !== false){
        header("location: ../createaccount.php?error=emailalreadyexists");
        exit();
    }
    
    createaccount($connect, $fname, $lname, $email, $pwd);
}
else {
    header("location: ../createaccount.php");
    exit();
}