<?php 

require_once 'vendor/autoload.php';

use App\Classes\User;

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){
  $user = new User();
  $user->register($_POST["username"],$_POST["email"],$_POST["password"]);
}


if(isset($_POST["user"])&& isset($_POST["pass"])){
  $user = new User();
  $user->login($_POST["user"],$_POST["pass"]);
}
?>

<form action="" method="post">
  <label>Username</label>
  <input type="text" id="name" name="username" /><br>
  <label>email</label>
  <input type="text" id="name" name="email" /><br>
  <label>Password</label>
  <input type="password" id="name" name="password" /><br>
  <input type="submit" value="Sign Up"/>
</form>

<form action="" method="post">
  <label>Username</label>
  <input type="text" id="name" name="user" /><br>
  <label>email</label>
  <input type="text" id="name" name="pass" /><br>

  <input type="submit" value="SignIN"/>
</form>