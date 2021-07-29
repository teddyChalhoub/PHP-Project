<?php 

namespace App\Classes;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connection{

  public function connect(){
    
    $dotEnv = Dotenv::createImmutable(dirname(__DIR__,2));
    $dotEnv->load();
    
    $servername = $_ENV["DB_SERVER"];
    $username = $_ENV["DB_USER"];
    $password = $_ENV["DB_PASS"];
    $db = $_ENV["DB_NAME"];
    
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