<?php 

namespace App\Classes;

use PDO;
use PDOException;

class Connection{

  public function connect(){
    
    $servername = "";
    $username = "";
    $password = "";
    $db = "";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}

?>