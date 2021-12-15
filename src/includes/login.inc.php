<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    $db= new MyPDO();

    if (emptyInputLogin($username, $password) !== false) {
        header('location: /login?error=emptyinput');
        exit();
    }

    loginUser($db, $username, $password);

} 