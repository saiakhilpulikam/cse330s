<?php
    session_start();
    require_once("class.php");
    validate_session();

    if($_GET['file'] != null) {
        delete_file(getUserPath(). $_GET['file']);
    }

    echo "<script> location.href='drive.php'; </script>";