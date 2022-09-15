<?=template_header('CreateAccount')?>

<div class="container">
    <div class="loginBody">
        <h1>CREATE ACCOUNT</h1>
                <form action="createaccount.inc.php" method="post">
                    <div class="loginInputContainer">
                        <input type="text" name="fname" placeholder="First Name">
                    </div>  
                    <div class="loginInputContainer">
                        <input type="text" name="lname" placeholder="Last Name">
                    </div> 
                    <div class="loginInputContainer">
                        <input type="text" name="email" placeholder="Email">
                    </div> 
                    <div class="loginInputContainer">
                        <input type="password" name="pwd" placeholder="Password">
                    </div> 
                    <div class="loginInputContainer">
                        <input type="password" name="passwordrepeat" placeholder="Repeat Password">
                    </div> 
                    <div class="loginInputContainer">
                        <button type="submit" class="btn" name="create">Create</button>
                    </div> 
                        <style>
                            .btn {
                                font-size: 16px;
                                font-family: arial;
                             }

                        </style>
                </form>
    </div>
</div>
    <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Fill in all fields!</p>";
        }
        if($_GET["error"] == "invalidemail"){
            echo "<p>Fill in all fields!</p>";
        }
        if($_GET["error"] == "invalidpassword"){
            echo "<p>Fill in all fields!</p>";
        }
        if($_GET["error"] == "passwordsdontmatch"){
            echo "<p>Fill in all fields!</p>";
        }
        if($_GET["error"] == "statementfailed"){
            echo "<p>Oops...Something Went Wrong!</p>";
        }
        if($_GET["error"] == "emailtaken"){
            echo "<p>Email alreadyexists</p>";
        }
        if($_GET["error"] == "none"){
            echo "<p>Successfully created account!</p>";
        }
    }
    ?>

<?=template_footer()?>