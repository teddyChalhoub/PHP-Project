<?php

use App\Classes\FileUpload;

require_once '../../vendor/autoload.php';

$file = new FileUpload($_REQUEST["userId"]);

$file->deleteFile($_REQUEST["id"]);

header('Location: ../../views/cloud.php');




?>