<?php
define("BASE_PATH", "/Users/saiakhilpulikam/Desktop/cse330s/module2/");
define("USER_DATA_PATH", BASE_PATH."userdata/");
define("USERS_FILE", BASE_PATH."users.txt");
define("PASSWORD_FILE", BASE_PATH."passwords.txt");

function getUserPath() {
    return USER_DATA_PATH.$_SESSION['user']."/";
}

//Author: Sai PuliKam, Charlie Yan
function searchfile($file, $id)
{
    $valid = FALSE;
    // Read from file
    $lines = file($file);
    foreach ($lines as $line) {
        // Check if the line contains the string we're looking for, and make $valid true if it does
        if (trim($line) == trim($id)) { //have to use trim method to get rid of the white space, otherwise it wouldn't match
            $valid = TRUE;
            break;
        }
    }
    return $valid;
}

function checkpassword($file, $id, $password)
{
    $valid = FALSE;
    // Read from file
    $lines = file($file);
    foreach ($lines as $line) {
        // Check if the line contains the string we're looking for, and make $valid true if it does
        //split string into two parts
        list($username, $key) = explode(" ", $line);
        if (trim($username) == trim($id))
            if (trim($key) == trim($password)) {
                $valid = TRUE;
                break;
            }
    }
    return $valid;
}

function upload_file($files)
{
    $result = false;
    $file = $files['file']['name'];

    if (move_uploaded_file($_FILES["file"]["tmp_name"], getUserPath() . $file)) {
        $result = true;
    } else {
        echo $_FILES["file"]["error"];
    }

    return $result;

}

function getFiles()
{
    $files = array();
    $unixfiles = array_diff(scandir(getUserPath()), array('.', '..'));
    foreach ($unixfiles as $file) {
        if(is_dir(getUserPath().$file)) continue;
        array_push($files, $file);
    }

    return $files;
}

function getFolders() {
    return $directories = glob(getUserPath()     . '*' , GLOB_ONLYDIR);
}


function delete_file($path)
{
    if (!unlink($path)) {
        echo("$path cannot be deleted due to an error");
    } else {
        // echo("$path has been deleted");
    }
}

//get folder size in a directory
function folderSize($dir)
{
    $size = 0;

    foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }

    $size = $size / 1048576;

    return round($size, 2);
}

//count file in a directory
function folderCount($dir)
{
    $files = scandir($dir);
    $filecount = count($files) - 2;
    return $filecount;
}

function validate_session() {
    if(!isset($_SESSION['user']) || !isset($_SESSION['key'])) {
        header("location: login.html");
        exit();
    }
}

function createFolder($name) {
    return mkdir(getUserPath().$name);
}
