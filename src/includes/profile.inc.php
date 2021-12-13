<?php

if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
     $lastname = $_POST['lastname'];
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirm = $_POST['confirm'];
     $userId = $_POST['currentUser'];
    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    $db= new MyPDO();

    if (emptyInputUpdate($firstname, $lastname, $username, $email, $password, $confirm) !== false) {
        header('location: ../profile.php?error=emptyinput');
        exit();
    }
    if (invalidUsername($username) !== false) {
        header('location: ../profile.php?error=invaliduser');
        exit();
    }
    if (invalidEmail($email) !== false) {
        header('location: ../profile.php?error=invalidemail');
        exit();
    }
    //if (strongPassword($password) !== false) {
    //    header('location: ../signup.php?error=weakpassword');
    //    exit();
    //}
    if (passwordMatch($password, $confirm) !== false) {
        header('location: ../profile.php?error=passwordnotmatch');
        exit();
    }
    if (usernameTaken($db, $username) !== false && $username !== $currentUser) {
        header('location: ../profile.php?error=usernametaken');
        exit();
    }
    
    updateUser($db, $firstname, $lastname, $username, $email, $password, $userId);

} else {
    header('location: ../profile.php');
    exit();
}