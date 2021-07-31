<?php 

  include "sidebar.php";

  session_start();
  require_once '../vendor/autoload.php';

  use App\Classes\Blog;

  $userId = $_SESSION["user"]["id"];
  
  $blog = new Blog($userId);

  // if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["overview"]) 
  // && isset($_POST["Add"])){

  //   $blog->addBlog($_POST["title"],$_POST["content"],$_POST["overview"]);
  // }

  if(isset($_POST["page"])){
    $page = $_POST["page"];
  }else{
    $page = 1;
  }

  $count_pages = json_decode(json_encode($blog->getBlogCount()), true)[0]["COUNT(*)"];
  $blogs = json_decode(json_encode($blog->getBlogByPage($page,10)), true);
  $blogData = json_decode(json_encode($blog->getBlog()), true);


?>

<html>
<head>
     <meta charset="utf-8">
          <!-- <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script> -->
          <link rel="stylesheet" href="./homepage.css">
        </head>
  <body>

<div class="homepage_container">
<!-- <form action="" method="post">

<Label for="title">Title</Label>
<input type="text" id="title" name="title"/>

<Label for="overview">Overview</Label>
<input type="text" id="overview" name="overview" />

<input type="submit" name="Add" value="Add"/>
<a href='../CRUD/ExportData.php?id=$id&userId=$userId'>Export</a>
<?php echo "<a href='./cloud.php?userId=$userId'>Cloud</a>"?>

<div >
  <textarea type="text" id="editor" name="content">
  </textarea>
</div>

</form> -->
<div class="container__export--btn">
<a href='../CRUD/ExportData.php?id=$id&userId=$userId'>Export</a>
</div>
<div>
  
  <?php foreach( $blogs as $value ){
    
      $id = $value["id"];
      $title=$value["title"];
      $content = $value["content"];
      $overview = $value["overview"];
      $datePublish=$value["created_at"];

      echo "<div class='card_design'>";
      echo "<p>Title: $title</p>";
      echo "<p>Overview: $overview</p>";
      echo "<div class='card_design--content'>";
      echo "<p>$content</p>";
      echo "<div class='card_design--btn'>";
      echo "<a href='../CRUD/DeleteBlog.php?id=$id&userId=$userId'><img src='../icons/delete.png' /></a>";
      echo "<a href='../CRUD/UpdateBlog.php?id=$id&userId=$userId'><img src='../icons/update.png' /></a>";
      echo "</div>";
      echo "</div>";
      echo "<p>$datePublish</p>";
      echo "</div>";
  }?>

</div>
<form  method="post">
  <div class="pagination_btn">
<?php 
for($i=1;$i<= ceil($count_pages/10);$i++){
  echo "<input type='submit' name='page' value=$i />";
} 
?>
</div>
</form>
<div class="container__add--btn">
<a href="../CRUD/AddBlog.php">+</a>
</div>
</div>

 <!-- <script>
    ClassicEditor
       .create( document.querySelector( '#editor' ) )
           .then( editor => {
                  console.log( editor );
             } )
            .catch( error => {
                console.error( error );
            } );
 </script> -->
</body>
</html>






