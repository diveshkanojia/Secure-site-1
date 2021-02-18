<?php

    include 'validation.php';
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="screen" href="css/style.css" type="text/css">


        <title>Secure site | CRUD operations</title>
    </head>
    <body>

        <?php
            if ($showAlert) {
                echo '<div class="success">
                    <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                    <strong>Success!</strong> You account has been created and you can login.
                </div>';
            }

            if ($showError) {
                echo '<div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                    <strong>Failed!</strong> '. $showError .'
                </div>';
            }

        ?>

        <div class="form-wrap">
            <div class="tabs">
                <h3 class="signup-tab"><a class="active" href="#signup-tab-content">Sign Up</a></h3>
                <h3 class="login-tab"><a href="#login-tab-content">Login</a></h3>
            </div>

            <div class="tabs-content">
                <div id="signup-tab-content" class="active">
                    <form class="signup-form" action="<?php $_SERVER["PHP_SELF"]?>" method="post">

                        <input type="email" class="input" id="user_email" name="user_email" autocomplete="off" placeholder="Email" value="<?= $email ?>">
                        <?php
                            if($emailError) {
                                echo '<span class="danger">*** ' .$emailError. '</span>';
                            }
                        ?>

                        <input type="text" class="input" id="user_name" name="user_name" autocomplete="off" placeholder="Username" value="<?= $username ?>" maxlength = "20">
                        <?php
                            if($usernameError) {
                                echo '<span class="danger">*** ' .$usernameError. '</span>';
                            }
                        ?>

                        <input type="password" class="input" id="user_pass" name="user_pass" autocomplete="off" placeholder="Password" maxlength = "30">
                        <?php
                            if($passError) {
                                echo '<span class="danger">*** ' .$passError. '</span>';
                            }
                        ?>

                        <input type="password" class="input" id="user_conform_pass" name="user_conform_pass" autocomplete="off" placeholder="Conform Password" maxlength = "30">
                        <?php
                            if($conformPassError) {
                                echo '<span class="danger">*** ' .$conformPassError. '</span>';
                            }
                        ?>
                        
                        <input type="text" class="input" id="user_phone_num" name="phone_num" autocomplete="off" placeholder="Phone Number" value="<?= $phone ?>" maxlength = "20">
                        <?php
                            if($phoneError) {
                                echo '<span class="danger">*** ' .$phoneError. '</span>';
                            }
                        ?>

                        <textarea class="input" id="user_addr" name="user_addr" rows="3" placeholder="Address..."></textarea>
                        <?php
                            if($addrError) {
                                echo '<span class="danger">*** ' .$addrError. '</span>';
                            }
                        ?>

                        <input type="submit" class="button" name="submit" value="Sign Up">

                    </form>
                    <div class="help-text">
                        <p>By signing up, you agree to our</p>
                        <p><a href="#">Terms of service</a></p>
                    </div>
                </div>

                <?php
                    include 'login_checker.php';
                ?>
                <div id="login-tab-content">
                    <form class="login-form" action="<?php $_SERVER["PHP_SELF"]?>" method="post">

                        <input type="email" class="input" id="user_email" name="user_email1" autocomplete="off" placeholder="Email" value="<?= $email ?>">
                        <?php
                            if($emailError) {
                                echo '<span class="danger">*** ' .$emailError. '</span>';
                            }
                        ?>

                        <input type="password" class="input" id="user_pass" name="user_pass1" autocomplete="off" placeholder="Password">

                        <input type="checkbox" class="checkbox" id="remember_me">
                        <label for="remember_me">Remember me</label>

                        <input name="submit1" type="submit" class="button" value="Login">
                    </form>
                    <div class="help-text">
                        <p><a href="#">Forget your password?</a></p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="js/jquery.js"></script>

    </body>
</html>



