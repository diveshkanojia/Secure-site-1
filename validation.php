<?php

    $emailError = $usernameError = $passError = $conformPassError = $phoneError = $addrError = "";
    $email = $username = $pass = $conformPass = $phone = $addr = "";
    $passwordChecker = true;
    $showAlert = false;
    $showError= false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])){
            $email = test_input($_POST["user_email"]);
            $username = test_input($_POST["user_name"]);
            $pass = test_input($_POST["user_pass"]);
            $conformPass = test_input($_POST["user_conform_pass"]);
            $phone = test_input($_POST["phone_num"]);
            $addr = test_input($_POST["user_addr"]);

            #validation of email
            if (empty($email)) {
                $emailError = "Email is required!";
            } else {
                # check if email address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                    $emailError = "Invalid email format";  
                }  
            }
            
            #validation of first name
            if (empty($username)){
                $usernameError = "First Name is required!";
            } else {
                # check if name only contain letters and whitespace 
                if (!preg_match ("/^[a-zA-z\s]*$/", $username)) {
                    $usernameError = "Only letter and white space allowed";
                }
            }


            #password validation 
            if (empty($pass)) {
                $passError = "Password cannot be empty.";
            } elseif (strlen($pass) < 8) {
                $passError .= "Password too short!";
            } elseif (strlen($pass) > 20) {
                $passError .= "Password too long!";
            } elseif (strlen($pass) < 8) {
                $error .= "Password too short!";
            } elseif ( !preg_match("#[0-9]+#", $pass)) {
                $passError .= "Password must include at least one number!";
            } elseif (!preg_match("#[a-z]+#", $pass)) {
                $passError .= "Password must include at least one letter!";
            } elseif (!preg_match("#[A-Z]+#", $pass)) {
                $passError .= "Password must include at least one CAPS!";
            } elseif (!preg_match("#\W+#", $pass)) {
                $passError .= "Password must include at least one symbol!";
            }

            #conform password validation
            if ($pass === "") {
                $conformPassError = "Please fill password first.";
            } elseif (empty($conformPass)) {
                $conformPassError = "Conform password cannot be empty.";
            } elseif ($conformPass !== $pass) {
                $conformPassError = "Password does not match";
            } elseif ($conformPass === $pass) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
            }

            #phone number validation
            if (empty($phone)) {
                $phoneError = "Phone number is required!";
            } else {
                // check if phone no is proper or not
                if(!preg_match ("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phone)){
                    $phoneError = "Invalid phone number";
                }
            }

            #Address validation
            if (empty($addr)) {
                $addrError = "Address field cannot be empty";
            }

            #query validation
            include 'dbConnect.php';

            // checking where the user name exist 
            $existSql = "SELECT * FROM user_details WHERE email = '{$email}'";

            $result = mysqli_query($conn, $existSql) or trigger_error("query failed!");

            $numExistRows = mysqli_num_rows($result);

            if ($numExistRows > 0) {
                $showError = "Email Id Already Exists";
            } else {
                if ($emailError == "" && $usernameError == "" && $passError == "" && $conformPassError == ""  && $phoneError == "" && $addrError == "") {

                    $sql = "INSERT INTO  user_details (email, username, pass, phone, addr) VALUES ('{$email}', '{$username}', '{$hash}', '{$phone}', '{$addr}')";
    
                    $result = mysqli_query($conn, $sql) or trigger_error("query failed!" . mysqli_error($conn));
    
                    if ($result) {
                        $showAlert = true;
                    }

                    $email = $username = $phone = "";

                }
            }
        }
    }

    function test_input ($data) {  
        $data = trim($data);  
        $data = stripslashes($data);  
        $data = htmlspecialchars($data);  
        return $data;  
    }
?>