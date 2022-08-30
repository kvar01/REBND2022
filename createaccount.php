<?=template_header('CreateAccount')?>

<div class="small-container">
    <div class="createAccount">
        <h1>CREATE ACCOUNT</h1>
            <div class="createAccountContainer">
                <form action="Includes/createaccount.inc.php" method="post">
                    <input type="text" name="fname" placeholder="First Name">
                    <input type="text" name="lname" placeholder="Last Name">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="passwordrepeat" placeholder="Repeat Password">
                    <button type="submit" class="btn" name="create">Create</button>
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
    </div>
</div>

<?=template_footer()?>