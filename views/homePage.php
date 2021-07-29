<?php 

  session_start();
  require_once '../vendor/autoload.php';

  use App\Classes\Blog;

  $userId = $_SESSION["user"]["id"];
  $blog = new Blog($userId);

  if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["overview"])){

    $blog->addBlog($_POST["title"],$_POST["content"],$_POST["overview"]);
  }


  $blogs = json_decode(json_encode($blog->getBlog()), true);

?>

<form action="" method="post">

<Label for="title">Title</Label>
<input type="text" id="title" name="title" />

<Label for="content">Content</Label>
<input type="text" id="content" name="content" />

<Label for="overview">Overview</Label>
<input type="text" id="overview" name="overview"/>

<input type="submit" value="Add"/>

</form>

<div>
  
  <?php foreach( $blogs as $value ){
    
      $id = $value["id"];
      $title=$value["title"];
      $content = $value["content"];
      $overview = $value["overview"];
      $datePublish=$value["created_at"];

      $_SESSION["article"]= $value;

      echo "<p>$title</p>";
      echo "<p>$content</p>";
      echo "<p>$overview</p>";
      echo "<p>$datePublish</p>";
      echo "<a href='../CRUD/DeleteBlog.php?id=$id&userId=$userId'>Delete</a>";
      echo "<a href='../CRUD/UpdateBlog.php?id=$id&userId=$userId'>Update</a>";
      
     
  }?>

</div>


