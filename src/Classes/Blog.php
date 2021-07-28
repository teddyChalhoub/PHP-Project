<?php 

namespace App\Classes;

use App\Classes\Connection;
use PDO;
use PDOException;

class Blog{

  protected int $userId;
  protected PDO $conn;

  public function __construct(int $userId){

    $db = new Connection();
    $this->conn = $db->connect();

    $this->userId = $userId;

  }


  public function addBlog(string $title, string $content, string $overview){

    try{
      echo $this->userId;
      $sql = "INSERT INTO blogs (title, overview, content,user_id) VALUES (:title, :overview, :content,:user_id)";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam("title",$title);
      $stmt->bindParam("content", $content);
      $stmt->bindParam("overview", $overview);
      $stmt->bindParam("user_id", $this->userId);

      $stmt->execute();

      echo "New record created successfully";


    }catch(PDOException $e){
      echo $sql . "<br>" . $e->getMessage();
    }

  }

  public function getBlog(){

    try{
      $stmt = $this->conn->prepare("SELECT * FROM blogs WHERE user_id = ?");
      $stmt->execute([$this->userId]);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }


  }

  public function updateBlog(){

  }

  public function deleteBlog(int $id){

    try{
      
      $sql = "DELETE FROM blogs WHERE id=?";
      $stmt= $this->conn->prepare($sql);
      $stmt->execute([$id]);

      echo "Record deleted successfully";
    }catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }


  }


}
