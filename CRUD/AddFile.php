<?php
session_start();

use App\Classes\FileUpload;

require_once '../vendor/autoload.php';
include "../views/sidebar.php";

$userId = $_SESSION["user"]["id"];
  
$fileUpload = new FileUpload($userId);


if(isset($_FILES["fileToUpload"]) && isset($_POST["submit"])){

  $target_dir = "../uploads/";
  $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));

  if(!empty($_POST["name"])){
    $_FILES["fileToUpload"]["name"] = $_POST["name"].".". $fileType;
  }

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;

  $name = $_FILES["fileToUpload"]["name"];
  $size = round($_FILES["fileToUpload"]["size"]/1024,2);
  $format = $fileType;
  $path = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  // Check if file already exists
  if (file_exists($target_file)) {
    $msgExist = "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $msg = "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
 
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $msgExist = $fileUpload->saveFile($name,$size,$format,$path);
      $msg = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      header("Location : ../views/cloud.php?Message=".$msg);
    } else {
      $msg = "Sorry, there was an error uploading your file.";
    }
  }
}


?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="../css/AddFile.css">

  </head>
<body>

<form  method="post" enctype="multipart/form-data">

  <?php 
  if(!empty($msg))
  { 
    echo"<p>$msgExist,$msg</p>";
  
  } 
  ?>
<label for="name">Name:</label><br>
  <input type="text" name="name" id="name"><br>
  <div class="file__btn_flex">
  <div class="select__file">
  <input type="file" name="fileToUpload" id="fileToUpload">
  </div>
  <input type="submit" id="submit" value="Upload file" name="submit">
  </div>
</form>
</body>
</html>