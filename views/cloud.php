<?php

use App\Classes\FileUpload;

  session_start();
  require_once '../vendor/autoload.php';
  // echo $_REQUEST["userId"];  
  $userId = $_REQUEST["userId"];
  $fileUpload = new FileUpload($userId);


  if(isset($_FILES["fileToUpload"]) && isset($_POST["submit"])){

    $target_dir = "../uploads/";
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
    $_FILES["fileToUpload"]["name"] = "teddy.". $fileType;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    $name = $_FILES["fileToUpload"]["name"];
    $size = round($_FILES["fileToUpload"]["size"]/1024,2);
    $format = $fileType;
    $path = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // echo $name."<br>";
    echo $size . "<br>";
    // echo $format."<br>";
    // echo $path ."<br>";

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
   
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $fileUpload->saveFile($name,$size,$format,$path);
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        // header("Location : ../views/cloud.php");
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  
  $files = json_decode(json_encode($fileUpload->getFiles()), true);
  print_r($files);

?>


<!DOCTYPE html>
<html>
<body>

<form  method="post" enctype="multipart/form-data">

  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload file" name="submit">
</form>
<div>
  
  <?php foreach( $files as $value ){
    
      $id = $value["id"];
      $name=$value["name"];
      $size = $value["size"];
      $format = $value["format"];
      $path = $value["path"];

      echo "<p>$name</p>";
      echo "<p>$size</p>";
      echo "<p>$format</p>";
      echo "<p>$path</p>";
      echo "<a href='../CRUD/DeleteFile.php?id=$id&userId=$userId'>Delete</a>";
      // echo "<a href='../CRUD/UpdateBlog.php?id=$id&userId=$userId'>Update</a>";
  }?>

</div>
</body>
</html>