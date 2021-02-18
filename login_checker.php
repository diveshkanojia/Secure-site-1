<?php

  $login = false;
  $showError = false;

  $email = $pass = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit1'])) {
      include 'dbConnect.php';

      $email = $_POST["user_email1"];
      $pass = $_POST["user_pass1"];
  
  
  
      $sql = "SELECT * FROM user_details WHERE email = '{$email}'";
  
      
  
      $result = mysqli_query($conn, $sql) or trigger_error("query failed!");
  
  
      $num = mysqli_num_rows($result);
  
      if ($num == 1) {

        while ($row = mysqli_fetch_assoc($result)) {
            if(password_verify($pass, $row['pass'])) {
                $login = true;
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $email;
                header("location: home.php");
            }
        }
      } else {
        $showError = "Invalid Credential";
      }
    }
  }
?>