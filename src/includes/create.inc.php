<?php 
require_once "db.inc.php";
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
}




// $name = $_POST['name'];
// $difficulty = $_POST['difficulty'];
// $distance = $_POST['distance'];
// $duration = $_POST['duration'];
// $elevation = $_POST['elevation'];


function createHike($db,$name, $difficulty, $distance, $duration, $elevation) {
  $db = new MyPDO();

  $CREATE_HIKE = "INSERT INTO hiking (name, difficulty, distance, duration, elevation, creator) VALUES (:name, :difficulty, :distance, :duration, :elevation, :creator);";
  $stmt = $db->prepare($CREATE_HIKE);
  
  $stmt->bindParam(":name", $name, PDO::PARAM_STR);
  $stmt->bindParam(":difficulty", $difficulty, PDO::PARAM_STR);
  $stmt->bindParam(":distance", $distance, PDO::PARAM_INT);
  $stmt->bindParam(":duration", $duration, PDO::PARAM_INT);
  $stmt->bindParam(":elevation", $elevation, PDO::PARAM_INT);

  $stmt->execute();
  print_r($stmt);

}

// if (!$CREATE_HIKE->execute()) {
  //   exit;
  // }
  // header("location: ../index.php")
