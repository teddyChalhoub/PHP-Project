<?php
session_start();

use App\Classes\Blog;

require_once '../vendor/autoload.php';
include "../views/sidebar.php";

$userId = $_SESSION["user"]["id"];
  
$blog = new Blog($userId);

if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["overview"]) 
&& isset($_POST["Add"])){

  $blog->addBlog($_POST["title"],$_POST["content"],$_POST["overview"]);

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
  <input type="text" id="title" name="title"/>

  <Label for="overview">Overview</Label>
  <input type="text" id="overview" name="overview" />

  <input class="add_btn" type="submit" name="Add" value="Add"/>

  <div class="editor">
    <textarea type="text" id="editor" name="content">
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
