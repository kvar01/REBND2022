<?=template_header('login')?>

<div class="container">
    <div class="loginBody">
        <h1>LOGIN</h1>
        <form action="login.inc.php" method="post">
            <div class="loginInputContainer">
                <input type="text" name="email" placeholder="Email">
            </div>
            <div class="loginInputContainer">
                <input type="password" name="pwd" placeholder="Password">
            </div>
            <div class="loginButtonContainer">
                <button type="submit" name="submit" class="btn">Login</button>
            </div>
            <div class="loginButtonContainer">
                <a href="index.php?page=createaccount" class="btn">Create Account</a> 
            </div>
            <div class="loginButtonContainer">
                <a href="index.php?page=adminlogin" class="btn">Admin Login</a>
            </div>
            <style>
                .btn {
                    font-size: 16px;
                    font-family: arial;
                }

            </style>
        </form>
    </div>
    <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Fill in all fields!</p>";
        }
        if($_GET["error"] == "loginincorrect"){
            echo "<p>Login information is incorrect!</p>";
        }
    }
    ?>
</div>

<?=template_footer()?>