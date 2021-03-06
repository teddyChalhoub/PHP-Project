<?php 

session_start();


require_once '../vendor/autoload.php';
include "../views/sidebar.php";

use App\Classes\Blog;

$userId = $_REQUEST["userId"];

$blog = new Blog($userId);

$blogDis = json_decode(json_encode($blog->getBlogById($_REQUEST["id"])), true);

if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["overview"])){

  $blog->updateBlog($_REQUEST["id"],$_POST["title"],$_POST["content"],$_POST["overview"]);

 header('Location: ../views/homePage.php'); 
}


?>

<html>
<head>
     <meta charset="utf-8">
          <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
          <link rel="stylesheet" href="../css/AddBLog.css">
        </head>
<body>


<div class="add_blog_container">

  <form action="" method="post">

  <Label for="title">Title</Label>
  <input type="text" id="title" name="title"  value=<?php echo $blogDis["title"]; ?>/>

  <Label for="overview">Overview</Label>
  <input type="text" id="overview" name="overview" value=<?php echo $blogDis["overview"];?>/>

  <input class="add_btn" type="submit" name="Add" value="Update"/>

  <div class="editor">
    <textarea type="text" id="editor" name="content">
    <?php echo $blogDis["content"]?>
    </textarea>
  </div>

  </form>
</div>

<script>
    ClassicEditor
       .create( document.querySelector( '#editor' ) )
           .then( editor => {
                  console.log( editor );
             } )
            .catch( error => {
                console.error( error );
            } );
 </script>
</body>
</html>
