<?php 

require_once '../vendor/autoload.php';

use App\Classes\Blog;


if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["overview"])){

  $blog = new Blog();
  $blog->addBlog($_POST["title"],$_POST["content"],$_POST["overview"]);

}

?>


<form action="" method="post">

<Label for="title">Title</Label>
<input type="text" id="title" name="title" />

<Label for="content">Content</Label>
<input type="text" id="content" name="content" />

<Label for="overview">Overview</Label>
<input type="text" id="overview" name="overview" />

<input type="submit" id="title" name="title" value="Add"/>

</form>