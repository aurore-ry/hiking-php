<?php
  require_once "./db.php";
  
  $db = new MyPDO();
  $stmt = $db->prepare('SELECT * FROM hiking');
  $stmt->execute();

  $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  // print_r($res)
  ?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/index.css">
  <title>Hikingders</title>
</head>
<body>

  <div class="container-box">
    <header>
      <div id="nav-hiking">

      </div>
    </header>
  <?php foreach ($res as $prop) : ?>
    <div class="hiking-container">
        <div class="hike-col"><p class="pointer">Place: </p> <p class="prop-data"><?php echo $prop["name"]; ?></p></div>
        <img src="<?php echo $prop["image"]?>" alt="">
        <div class="hike-col"><p class="pointer">Difficulty: </p><p class="prop-data"><?php echo $prop["difficulty"]; ?></p></div>
        <div class="hike-col"><p class="pointer">Distance:</p><p class="prop-data"><?php echo $prop["distance"]; ?></p></div>
        <div class="hike-col"><p class="pointer">Duration:</p><p class="prop-data"><?php echo $prop["duration"]; ?></p></div>
        <div class="hike-col"><p class="pointer">Elevation:</p><p class="prop-data"><?php echo $prop["elevation"]; ?></p></div>
    </div>
   <?php endforeach; ?>
  </div>
</body>
</html>