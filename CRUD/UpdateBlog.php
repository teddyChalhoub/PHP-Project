<?php 

session_start();


require_once '../vendor/autoload.php';

use App\Classes\Blog;

$blog = new Blog($_REQUEST["userId"]);

print_r($_SESSION["article"]);

if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["overview"])){

  $blog->updateBlog($_SESSION["article"]["id"],$_POST["title"],$_POST["content"],$_POST["overview"]);
  header('Location: ../views/homePage.php'); 
}


?>

<form action="" method="post">

<Label for="title">Title</Label>
<input type="text" id="title" name="title" value=<?php echo $_SESSION["article"]["title"]; ?> />

<Label for="content">Content</Label>
<input type="text" id="content" name="content" value=<?php echo $_SESSION["article"]["content"];?> />

<Label for="overview">Overview</Label>
<input type="text" id="overview" name="overview" value=<?php echo $_SESSION["article"]["overview"];?> />

<input type="submit" value="Update"/>

</form>