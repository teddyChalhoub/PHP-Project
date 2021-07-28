<?php

require_once '../vendor/autoload.php';

use App\Classes\Blog;

$blog = new Blog($_REQUEST["userId"]);

$blog->deleteBlog($_REQUEST["id"]);

header('Location: ../views/homePage.php');

?>
