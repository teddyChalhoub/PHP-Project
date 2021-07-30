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

  public function getFileById(int $fileId){

    try{
      $stmt = $this->conn->prepare("SELECT * FROM filesUploads WHERE id = ?");
      $stmt->execute([$fileId]);
      return $stmt->fetch(PDO::FETCH_OBJ);
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }

  }

  public function updateFile(int $id,string $name){
    echo $name;
    try{

      $stmt= $this->conn->prepare("UPDATE filesUploads SET name = ? WHERE id=?");
      $stmt->execute([$name,$id]);
      echo "Record updated successfully";
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }
  }

    
  public function unlinkFileById(int $fileId){

    try{
      $stmt = $this->conn->prepare("SELECT * FROM filesUploads WHERE id = ?");
      $stmt->execute([$fileId]);
      $file =  json_decode(json_encode($stmt->fetch(PDO::FETCH_OBJ)), true); 
      unlink("../".$file["path"]);
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }

  }

  public function deleteFile(int $id){

    try{

      $this->unlinkFileById($id);
      $sql = "DELETE FROM filesUploads WHERE id=?";
      $stmt= $this->conn->prepare($sql);
      $stmt->execute([$id]);
      print_r($stmt->fetch());
      echo "Record deleted successfully";
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }
  }


}


?>