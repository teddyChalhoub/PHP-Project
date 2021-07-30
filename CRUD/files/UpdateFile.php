<?php

require_once '../../vendor/autoload.php';

use App\Classes\FileUpload;

$userId = $_REQUEST["userId"];
echo $userId;
$file = new FileUpload($userId);

$fileDis = json_decode(json_encode($file->getFileById($_REQUEST["id"])), true);

if(isset($_POST["name"])){

  $file->updateFile($_REQUEST["id"],$_POST["name"]);

  header('Location: ../../views/cloud.php'); 

}

?>

<form  method="post" enctype="multipart/form-data">

  <input type="text" name="name" id="name">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Update name" name="submit">
</form>