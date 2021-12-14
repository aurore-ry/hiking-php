<?php

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
     $difficulty = $_POST['difficulty'];
     $distance = $_POST['distance'];
     $duration = $_POST['duration'];
     $elevation = $_POST['elevation'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';
    $db= new MyPDO();

    if (emptyInputAddHike($name, $difficulty, $distance, $duration, $elevation) !== false) {
        header('location: ../addhike.php?error=emptyinput');
        exit();
    }
    if (invalidName($name) !== false) {
        header('location: ../addhike.php?error=invaliddistance');
        exit();
    }
    if (invalidDifficulty($difficulty) !== false) {
        header('location: ../addhike.php?error=invaliddifficulty');
        exit();
    }
    if (invalidDistance($distance) !== false) {
        header('location: ../addhike.php?error=invaliddistance');
        exit();
    }
    if (invalidDuration($duration) !== false) {
        header('location: ../addhike.php?error=invalidduration');
        exit();
    }
    if (invalidElevation($elevation) !== false) {
        header('location: ../addhike.php?error=invalidelevation');
        exit();
    }


    addHike($db, $name, $difficulty, $distance, $duration, $elevation);

} else {
    header('location: ../signup.php');
    exit();
}