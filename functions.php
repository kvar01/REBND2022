<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'rebnd';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="rebnd.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                    <h1><a href="index.php" style="color: #000"><img src="Images/Store1.png"></a></h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                    <a href="index.php?page=contact">Contact</a>
                    <a href="index.php?page=login">Account</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year REBND</p>
            </div>
        </footer>
    </body>
</html>
EOT;
}
?>

<?php

function emptyInputCreateAccount($fname, $lname, $email, $pwd, $passwordrepeat) {
    $result;
    if (empty($fname) || empty($lname) || empty($email) || empty($pwd) || empty($passwordrepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidfname($fname) {
    $result;
    if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidlname($lname) {
    $result;
    if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidemail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}
function passwordmatch($pwd, $passwordrepeat) {
    $result;
    if ($pwd !== $passwordrepeat) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}
function emailExists($connect, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($connect);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../createaccount.php?error=statementfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    
    mysqli_stmt_close($stmt);
        
}
function createaccount($connect, $fname, $lname, $email, $pwd) {
    $sql = "INSERT INTO users (usersFname, usersLname, usersEmail, usersPassword) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connect);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../createaccount.php?error=statementfailed");
        exit();
    }
    
    $passwordHash = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $passwordHash);
    mysqli_stmt_execute($stmt);    
    mysqli_stmt_close($stmt);
    header("location: ../createaccount.php?error=none");
    exit();    
}

function emptyInputLogin($email, $pwd) {
    $result;
    if ( empty($email) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function userLogin($connect, $email, $pwd){
    $emailExists = emailExists($connect, $email);
    
    if($emailExists === false){
        header("location: ../login.php?error=loginincorrect");
        exit();
    }
    
    $hashedPwd = $emailExists["usersPassword"];
    $checkPwd = password_verify($pwd, $hashedPwd);
    
    if($checkPwd === false) {
        header("location: ../login.php?error=loginincorrect");
        exit();
    }
    else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $emailExists["usersId"];
        $_SESSION["useremail"] = $emailExists["usersEmail"];
        header("location: ../REBND_Home.php");
        exit();
    }
}
function adminEmailExists($connect, $adminEmail) {
    $sql2 = "SELECT * FROM admin WHERE adminEmail = ?;";
    $stmt2 = mysqli_stmt_init($connect);
    if(!mysqli_stmt_prepare($stmt2, $sql2)){
        header("location: ../createaccount.php?error=statementfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt2, "s", $adminEmail);
    mysqli_stmt_execute($stmt2);
    
    $resultData2 = mysqli_stmt_get_result($stmt2);
    
    if($row2 = mysqli_fetch_assoc($resultData2)){
        return $row2;
    }
    else{
        $result2 = false;
        return $result2;
    }
    
    mysqli_stmt_close($stmt2);
}
    
function emptyAdminInputLogin($adminEmail, $adminPwd) {
    $result;
    if ( empty($adminEmail) || empty($adminPwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function adminLogin($connect, $adminEmail, $adminPwd){
    $adminEmailExists = adminEmailExists($connect, $adminEmail);
    
    if($adminEmailExists === false){
        header("location: ../REBND_AdminLogin.php?adminerror=loginincorrect");
        exit();
    }  
    
    $adminPwdHash = password_hash('admin12345', PASSWORD_DEFAULT);
    $dbPwd = $adminEmailExists["adminPassword"];
    $checkAdminPwd = password_verify($dbPwd, $adminPwdHash);
    
    if($checkAdminPwd === false) {
        header("location: ../REBND_Adminlogin.php?adminerror=pwincorrect");
        exit();
    }
    else if($checkAdminPwd === true) {
        session_start();
        $_SESSION["adminid"] = $adminEmailExists["adminId"];
        $_SESSION["adminemail"] = $adminEmailExists["adminEmail"];
        header("location: ../EmployeeIndexPage.php");
        exit();
    }
}
function get_single_product($products){
    global $db;
    $ret = array();
    $sql = "SELECT * FROM product";
    $res = mysqli_query($db, $sql);
    
    while($ar = mysqli_fetch_assoc($res))
    {
        $ret[] = $ar;
    }
    return $ret;
}