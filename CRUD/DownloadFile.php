<?php

use App\Classes\FileUpload;

require_once '../vendor/autoload.php';
session_start();

$userId = $_SESSION["user"]["id"]; 
$files = new FileUpload($userId);

$file = json_decode(json_encode($files->getFileById($_REQUEST["id"])), true);

// echo  $file["name"];
if (file_exists($file["path"])) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . basename($file["path"]) . '"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file["path"]));
  flush();
	readfile($file["path"],true);
	die();
}else{
  $msg =  "File does not exist.";

}


header("Location: ../views/cloud.php?message=".$msg);

?>