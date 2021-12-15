<?php

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
     $difficulty = $_POST['difficulty'];
     $distance = $_POST['distance'];
     $duration = $_POST['duration'];
     $elevation = $_POST['elevation'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    $db = new MyPDO();


    addHike($db, $name, $difficulty, $distance, $duration, $elevation);

} else { 
    if (!isset($_SESSION["username"])) {
        header('location: /login?error=notlogged');
        exit();
    }
}