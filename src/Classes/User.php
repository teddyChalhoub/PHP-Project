<?php

namespace App\Classes;

use App\Classes\Connection;
use PDO;
use PDOException;

class User{

  protected PDO $conn;

  function __construct(){

    $db = new Connection();
    $this->conn = $db->connect();
  
  }

  public function fetchByUser($username){
    try{
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
      $stmt->execute([$username]);
      return $stmt->fetch();
    } catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }
  }

  public function fetchByEmail($email){
    try{
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->execute([$email]);
      return $stmt->fetch();
    } catch(PDOException $e){
      echo "<br>" . $e->getMessage();
    }
  }

  public function register(string $username,string $email,string $pass){

    try {

      $check_email = filter_var($email, FILTER_VALIDATE_EMAIL);
     


     if(!$check_email) {
      throw new PDOException("Invalid email format");
    }

  
      $user = $this->fetchByUser($username);
      $mail= $this->fetchByEmail($email);
      if($user || $mail) throw new PDOException("Already registered");

      $uppercase = preg_match('@[A-Z]@', $pass);
      $lowercase = preg_match('@[a-z]@', $pass);
      $number    = preg_match('@[0-9]@', $pass);
      $specialChars = preg_match('@[^\w]@', $pass);

      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
          throw new PDOException( 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
      }

      $hash_pass = password_hash($pass,PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (username, email, password) VALUES (:username,:email,:password)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam("username",$username);
      $stmt->bindParam("email", $email);
      $stmt->bindParam("password", $hash_pass);

      $stmt->execute();
      header('Location: ../../index.php');
      echo "New record created successfully";
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    return null;

}


public function login(string $username,string $pass){

 

    $pattern = filter_var($username, FILTER_VALIDATE_EMAIL);

    if($pattern){
      echo "email";
      $user = $this->fetchByEmail($username);
    }else{
      echo "user";
    $user = $this->fetchByUser($username);
    }

   

    if ($user && password_verify($pass, $user['password']))
    {
      session_start();
      $_SESSION["user"] = $user;
        header('Location: ./views/homePage.php');
    } else {
        echo "invalid";
    }

  }


}

?>