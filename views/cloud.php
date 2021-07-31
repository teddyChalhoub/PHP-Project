<?php
include "sidebar.php";
use App\Classes\FileUpload;

  session_start();

  require_once '../vendor/autoload.php';
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
      echo "Sorry, file already exists.";
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

  if(isset($_POST["page"])){
    $page = $_POST["page"];
  }else{
    $page = 1;
  }
  
  $count_pages = json_decode(json_encode($fileUpload->getFilesCount()), true)[0]["COUNT(*)"];
  $files = json_decode(json_encode($fileUpload->getFileByPage($page,10)), true);
  $fileData = json_decode(json_encode($fileUpload->getFiles()), true);

?>


<!DOCTYPE html>
<html>
<body>

<form  method="post" enctype="multipart/form-data">

  <input type="text" name="name" id="name">
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
      echo "<p>$size KB</p>";
      echo "<p>$format</p>";
      echo "<p>$path</p>";
      echo "<a href='../CRUD/files/DeleteFile.php?id=$id&userId=$userId'>Delete</a>";
      echo "<a href='../CRUD/UpdateFile.php?id=$id&userId=$userId'>Update</a>";
  }?>

</div>
<form  method="post">

<?php 
for($i=1;$i<= ceil($count_pages/10);$i++){
  echo "<input type='submit' name='page' value=$i />";
} 
?>

</form>
</body>
</html>