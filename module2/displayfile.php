<?php
session_start();

require_once("class.php");
validate_session();

$filePath = getUserPath().$_GET['file'];

header('Content-Description: File Transfer');
header('Content-Type: '.mime_content_type($filePath).'');
header('Content-Disposition: inline; filename="'. $_GET['file'].'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
flush();
readfile($filePath);