<?php
include_once 'components/starter.php';
require_once "./includes/db.inc.php";
  
    $db = new MyPDO();
  
  try {
    $sql = "SELECT * FROM hiking;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
} catch(Exception $e) {
    echo $e->getMessage();
    header('location: ../index.php?error=stmtfailed');
    exit;
}
$res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikingder</title>
    <link rel="stylesheet" href="./styles/signup.css">
</head>
<body>
  <?php
  include_once './components/header.php';
  ?>
    <div class="form">
      <h1>Hikings</h1>
      <div id="hike-app">
      <div id="header-hike-bar">
        <div id="nav-hiking">
          <form action="">
            <input type="text" name="Search..." id="search" placeholder="Search...">
          </form>
        </div>
      </div>
      </div>
      <div class="container-box">
        <?php foreach ($res as $prop) : ?>
          <div class="hiking-container">
            <div class="hike-col"><p class="pointer">Place: </p> <p class="prop-data"><?php echo $prop["name"]; ?></p></div>
            <img class="illustration" src="<?php echo $prop["image"]?>" alt="">
            <div class="hike-col"><p class="pointer">Difficulty: </p><p class="prop-data"><?php echo $prop["difficulty"]; ?></p></div>
            <div class="hike-col"><p class="pointer">Distance:</p><p class="prop-data"><?php echo $prop["distance"]; ?> km</p></div>
            <div class="hike-col"><p class="pointer">Duration:</p><p class="prop-data"><?php echo $prop["duration"]; ?> h</p></div>
            <div class="hike-col"><p class="pointer">Elevation:</p><p class="prop-data"><?php echo $prop["elevation"]; ?> m</p></div>

            <form action="includes/myhikings.inc.php" method="post">
              <input type="hidden" name="like" value="<?php echo $prop["id"]; ?>">

            <button name="submit" class="hide" type="submit">like</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>


  <?php
  require_once './components/footer.php'
  ?>
</body>
</html>