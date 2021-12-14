<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
}

if (isset($_POST['submit'])) {

    $hikingid = $_POST['like'];
    $userId = $_SESSION['id'];
    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    $db= new MyPDO();

    removeLike($db, $hikingid, $userId);

} else {
    header('location: ../index.php?error=nolike');
    exit();
}

