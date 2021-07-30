<?php

    require_once 'vendor/autoload.php';

    use App\Classes\User;

    if(isset($_POST['name'])) {
        $user = new User();
        $user->store($_POST['name'], $_POST['email']);
    }
?>

<form action="" method="post">
    <label for="name">Name</label>
    <input id="name" name="name">
    <br/>
    <label for="email">Email</label>
    <input id="email" name="email">
    <br/>

    <input type="submit" value="Submit">
</form>

