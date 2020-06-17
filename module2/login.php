<?php
            //header_remove();
            session_start();
            require_once('class.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="driveapp.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <a class="message">
            <?php
            //header_remove();
            //session_start();
            //require_once('class.php');

            $username = $_GET['username'];
            $password = $_GET['password'];

            if (!preg_match('/^[\w_\.\-]+$/', $username)) {
                echo "Invalid username.";
            } else if (!preg_match('/^[\w_\.\-]+$/', $password)) {
                echo "Invalid password.";
            } else if (!searchfile("users.txt", $username)) {
                echo "Username not found.";
            } else if (!checkpassword("passwords.txt", $username, $password)) {
                echo "Password does not match.";
            } else {
                // best to have it here after validation has passed just before moving to the drive page.
                $_SESSION['user'] = $username;
                $_SESSION['key'] = $password;

                echo "<script> location.href='drive.php'; </script>";
                //header("location: drive.php");
            }
            ?>
        </a>
        <button type="submit" onclick="location.href = 'register.html';" class="return">Go To The Sign Up</button>
        <button type="submit" onclick="location.href = 'login.html';" class="return">Back To The Log In</button>
    </div>
</div>
</body>
</html>

