<?php

require_once '../vendor/autoload.php';

use App\Classes\FileUpload;

$userId = $_REQUEST["userId"];
$file = new FileUpload($userId);

$fileDis = json_decode(json_encode($file->getFileById($_REQUEST["id"])), true);

if(isset($_POST["name"])){

  $file->updateFile($_REQUEST["id"],$_POST["name"]);

  header('Location: ../views/cloud.php'); 

}

?>
<html>
<head>
     <meta charset="utf-8">
</head>
<body>
<form  method="post" enctype="multipart/form-data">

  <input type="text" name="name" id="name" value=<?php echo $fileDis["name"] ?>>
  <input type="submit" value="Update File name" name="submit">
</form>

</body>