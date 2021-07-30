<?php

namespace App\Classes;

use App\Classes\Connection;
use PDO;
use PDOException;

class FileUpload{


  protected PDO $conn;
  protected int $userId;

  function __construct(int $userId){
    
    $db = new Connection();
    $this->conn = $db->connect();

    $this->userId = $userId;
  }

  public function saveFile(string $filename,$size,string $format,string $path){
    echo $size ."<br>";
    try{
      $sql = "INSERT INTO filesUploads (name, size, format,path,user_id) VALUES (:name,:size,:format,:path,:userId)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam("name",$filename);
      $stmt->bindParam("size", $size,PDO::PARAM_STR);
      $stmt->bindParam("format", $format);
      $stmt->bindParam("path", $path);
      $stmt->bindParam("userId", $this->userId);

      $stmt->execute();
      echo "New record created successfully";
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  public function getFiles(){

    try{
      $stmt = $this->conn->prepare("SELECT * FROM filesUploads WHERE user_id = ?");
      $stmt->execute([$this->userId]);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }


  }


}


?>