<?php
session_start();
require_once ("class.php");

validate_session();

$folderName = $_GET['name'];
if($folderName != "null") {
    createFolder($folderName);
}
header("location: drive.php");