<?php
  require_once "./includes/dbh.inc.php";
  
  $db = new MyPDO();
  $stmt = $db->prepare('SELECT * FROM hiking');
  $stmt->execute();

  $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  // print_r($res)
  ?> 


<?php
include_once 'components/header.php';
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
  <?php foreach ($res as $prop) : ?>
    <div class="hiking-container">
        <div class="hike-col"><p>Place: </p><?php echo $prop["name"]; ?></div>
        <div class="hike-col"><p>Difficulty: </p><?php echo $prop["difficulty"]; ?></div>
        <div class="hike-col"><p>Distance:</p><?php echo $prop["distance"]; ?></div>
        <div class="hike-col"><p>Duration:</p><?php echo $prop["duration"]; ?></div>
        <div class="hike-col"><p>Elevation:</p><?php echo $prop["elevation"]; ?></div>
    </div>
   <?php endforeach; ?>
</body>
</html>
<?php
require_once './components/footer.php'
?>