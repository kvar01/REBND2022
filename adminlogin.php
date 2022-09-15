<?=template_header('AdminLogin')?>

<div class="container">
    <div class="loginBody">
        <h1>ADMINISTRATOR LOGIN</h1>
        <form action="Includes/adminlogin.inc.php" method="post">
            <div class="loginInputContainer">
                <input type="text" name="adminEmail" placeholder="Admin Email" />
            </div>
            <div class="loginInputContainer">
                <input type="password" name="adminPwd" placeholder="Password" />
            </div>
            <div class="loginButtonContainer">
                <button type="submit" name="submitAdmin" class="btn">Login</button>
            </div>
            <style>
                .btn {
                    font-size: 16px;
                }
            </style>
        </form>
    </div>
</div>
    <?php
    if(isset($_GET["adminerror"])){
        if($_GET["adminerror"] == "emptyinput"){
            echo "<p>Fill in all fields!</p>";
        }
        if($_GET["adminerror"] == "loginincorrect"){
            echo "<p>Login information is incorrect!</p>";
        }
    }
    ?>

<?=template_footer()?>