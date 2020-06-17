<?php 
session_start();
require_once("class.php");
validate_session();

// ini_set('post_max_size', '1000M');
// ini_set('upload_max_filesize', '1000M');
// ini_set('memory_limit', '1000M');
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html lang="en">
<head>
    <!--<link rel = "stylesheet" href = "driveapp.css"> -->
    <meta charset="utf-8" />
    <link rel="stylesheet" href="driveapp.css">
    <title>File sharing Site</title>
</head>

<body>


<?php

$files = getFiles();
$folders = getFolders();
?>
<div class="drive-header">
    <h1>Driveapp<h1>
</div>

<div class="drive-navbar">
    <a href='' class="left">Help</a>
    <a href='' class="left">Setting</a>
    <!-- <a href="javascript:void(0);" onclick="createFolder();" class="left">Create Folder</a> -->

    <a href="logout.php" class="right">Log out</a>
</div>

<p>&nbsp;</p>
</div>

<div class="drive-upload">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $result = upload_file($_FILES);
        if ($result) {
            echo "<script> location.href='drive.php'; </script>";
        } else {
            echo "Upload Failure";
        }
    }
    ?>
    <div class='card'>
        <h2>Upload Files</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" class="choose"/>
            <input type="submit" value="Upload" class="upload"/>
        </form>
    </div>

    <div class='card2'>
        <h2>Storage Statistic</h2>
        <div class="stat">
            <?php
            $folderSize = folderSize(getUserPath());
            echo ("Your Drive Occupies " . $folderSize) . "mb";
            echo "</br>";

            echo ("Your Drive Has " . sizeof($files)) . " files";// and " . sizeof($folders) . " folders.";
            ?>
        </div>

    </div>
</div>

<div class="drive-main">
    <!-- <div class='card'>
        <h2>Your Folders</h2>
        <table>
            <tr>
                <?php
            //     foreach ($folders as $folder) {
            //         echo "<td>
            //         <p><img src='folder.png' width='124' alt='" . basename($folder) . "}' /></p>
            //         <p align='center'>" . basename($folder) . "</p>
            //   </td>";
            //     }
                ?>
            </tr>
        </table>
    </div> -->


    <div class='card'>
        <h2>Your Files</h2>
        <div class="form">
            <?php
            foreach ($files as $file) {
                $size = filesize(getUserPath() . $file) / 1048576;
                $size = round($size, 2);
                echo "<div class='drive-item'><a target='_blank' class='left' href='displayfile.php?file=" . $file . "'>$file</a><a class='right' href='download.php?file=" . $file . "'>download</a><a class='right' href='delete.php?file=" . $file . "'>delete</a><a class='right'>$size kb</a></div>";
            }
            ?>
        </div>
    </div>
</body>
<script>
    function createFolder() {
        let folder = prompt("Please enter folder name");
        if (folder !== null) {
            window.location.href = "createfolder.php?name=" + folder;
        }
    }
</script>
</html>