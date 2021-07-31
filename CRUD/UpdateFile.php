<?php

require_once '../vendor/autoload.php';

include "../views/sidebar.php";
use App\Classes\FileUpload;

$userId = $_REQUEST["userId"];
$file = new FileUpload($userId);

$fileDis = json_decode(json_encode($file->getFileById($_REQUEST["id"])), true);

if(isset($_POST["name"])){

  $file->updateFile($_REQUEST["id"],$_POST["name"]);

  header('Location: ../views/cloud.php'); 

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
  <input type="text" name="name" id="name" value=<?php echo $fileDis["name"] ?> ><br>
  <input type="submit" id="submit" value="Update file" name="submit">
  </div>
</form>
</body>
</html>