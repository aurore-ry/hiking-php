<?php

if (isset($_SESSION["username"])) {
    header("location: /");
    exit();
}
  

if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
     $lastname = $_POST['lastname'];
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirm = $_POST['confirm'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    $db= new MyPDO();

    if (emptyInputSignup($firstname, $lastname, $username, $email, $password, $confirm)) {
        header('location: /signup?error=emptyinput');
        exit();
    }
    if (invalidUsername($username)) {
        header('location: /signup?error=invaliduser');
        exit();
    }
    if (invalidEmail($email)) {
        header('location: /signup?error=invalidemail');
        exit();
    }
    //if (strongPassword($password)) {
    //    header('location: /signup?error=weakpassword');
    //    exit();
    //}
    if (passwordMatch($password, $confirm)) {
        header('location: /signup?error=passwordnotmatch');
        exit();
    }
    if (usernameTaken($db, $username)) {
        header('location: /signup?error=usernametaken');
        exit();
    }

    createUser($db, $firstname, $lastname, $username, $email, $password);

} 