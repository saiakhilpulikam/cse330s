<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New User</title>
    <link rel="stylesheet" href="driveapp.css">
    <meta charset="utf-8" />
</head>
<body>
<div class="wrapper">
    <div class="container">

        <a class="message">
            <?php
            //session_start();
            require_once('class.php');

            $new_username = $_GET['new_username'];
            $new_password = $_GET['new_password'];

            if (!preg_match('/^[\w_\.\-]+$/', $new_username)) {
                echo "Invalid username.";
            } else if (!preg_match('/^[\w_\.\-]+$/', $new_password)) {
                echo "Invalid username.";
            }
            else if (searchfile(USERS_FILE, $new_username)) {
                echo "Username taken.";
            } else {
                mkdir(USER_DATA_PATH . $new_username);
                file_put_contents(USERS_FILE, $new_username . "\n", FILE_APPEND);
                file_put_contents(PASSWORD_FILE, $new_username . " " . $new_password."\n", FILE_APPEND);
                echo "You have successfully registered.";
            }
            ?>
        </a>

        <button type="submit" onclick="location.href = 'register.html';" class="return">Back To The Sign Up</button>
        <button type="submit" onclick="location.href = 'login.html';" class="return">Back To The Log In</button>
    </div>
</div>
</body>
</html>