<?php
include "sidebar.php";
use App\Classes\FileUpload;

  session_start();

  print_r($_SESSION['user']);
  if(!isset($_SESSION['user']) && empty($_SESSION['user'])){

    header("Location: ../index.php");
  
  }

  require_once '../vendor/autoload.php';
  $userId = $_SESSION["user"]["id"];
  $fileUpload = new FileUpload($userId);

  if($_REQUEST["Message"]){
    echo $_REQUEST["Message"];
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
  <head>
  <link rel="stylesheet" href="./cloud.css">

  </head>
<body>
<div class="file__container">
<div class="file__container__details">
  
  <?php foreach( $files as $value ){
    
      $id = $value["id"];
      $name=$value["name"];
      $size = $value["size"];
      $format = $value["format"];
      $path = $value["path"];

      echo "<div class='file__container__details--info'>";
      echo "<p>$name</p>";
      echo "<p>$size KB</p>";
      echo "<a href='../CRUD/files/DeleteFile.php?id=$id&userId=$userId'><img src='../icons/delete.png' /></a>";
      echo "<a href='../CRUD/UpdateFile.php?id=$id&userId=$userId'><img src='../icons/update.png' /></a>";
      echo "<a href='../CRUD/DownloadFile.php?id=$id&userId=$userId'><img src='../icons/download.png' /></a>";
      echo "</div>";
  }?>

</div>
<form  method="post">
<div class="pagination_btn">
<?php 
for($i=1;$i<= ceil($count_pages/10);$i++){
  echo "<input class='paginated--btn' type='submit' name='page' value=$i />";
} 
?>
</div>
<div class="container__add--btn">
<a href="../CRUD/AddFile.php">+</a>
</div>
</form>
</div>
</body>
</html>