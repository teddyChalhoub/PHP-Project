<?php

require_once 'vendor/autoload.php';


use App\Classes\User;


if(isset($_POST["user"])&& isset($_POST["pass"])){
  $user = new User();
  $user->login($_POST["user"],$_POST["pass"]);
}


if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){

  $user = new User();
  $user->register($_POST["username"],$_POST["email"],$_POST["password"]);
}

?>

<html>
<header>
<link rel="stylesheet" href="./index.css">
</header>
<div class="login-wrap">
  <form method="post">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" name="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In">
				</div>
			</div>
 </form>
 <form method="post">
			<div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" name="username" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="password" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="email" class="label">Email Address</label>
					<input id="email" name="email" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
 </form>
</div>
</html>