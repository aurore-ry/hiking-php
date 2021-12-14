<?php 
require_once "db.inc.php";

session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
}

$db = new MyPDO();

$name = $_POST['name'];
$createdAt = $_POST['createdAt'];
$difficulty = $_POST['difficulty'];
$distance = $_POST['distance'];
$duration = $_POST['duration'];
$elevation = $_POST['elevation'];
// $creator = $_POST['creator'];


function createHike($db,$name, $createdAt, $difficulty, $distance, $duration, $elevation, $creator) {
   
  $CREATE_HIKE = "INSERT INTO hiking (name, createdAt, difficulty, distance, duration, elevation, creator) VALUES (:name, :createdAt, :difficulty, :distance, :duration, :elevation, :creator);";
  $stmt = $db->prepare($CREATE_HIKE);
  
  $stmt->bindParam(":name", $name, PDO::PARAM_STR);
  $stmt->bindParam(":createdAt", $createdAt, PDO::PARAM_INT);
  $stmt->bindParam(":difficulty", $difficulty, PDO::PARAM_STR);
  $stmt->bindParam(":distance", $distance, PDO::PARAM_INT);
  $stmt->bindParam(":duration,", $duration, PDO::PARAM_STR);
  $stmt->bindParam(":elevation,", $elevation, PDO::PARAM_INT);
  $stmt->bindParam(":creator", $creator, PDO::PARAM_INT);

  $stmt->execute();
     
}

?>



