<?php
require_once './includes/db.inc.php';

session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
}
require_once './components/header.php';

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
    <title>Hikingder</title>
</head>
<body>
  <div id="hike-app">
    <header id="header-hike-bar">
      <div id="nav-hiking">
        <form action="">
          <input type="text" name="Search..." id="search" placeholder="Search...">
        </form>
      </div>
      <button class="open-button" onclick="openForm()">ADD HIKE</button>
        <div class="form-popup" id="myForm">
         <form action="includes/create.inc.php" class="form-container" method="post">
           <h1>Add an hike</h1>

           <label for="name"><b>Name</b></label>
           <input type="text" placeholder="Hike Name" name="name" required>

           <label for="difficulty"><b>very easy</b></label>
           <input type="radio" placeholder="Difficulty grade" name="difficulty" required>

           <label for="difficulty"><b>easy</b></label>
           <input type="radio" placeholder="Difficulty grade" name="difficulty" required>

           <label for="difficulty"><b>soft</b></label>
           <input type="radio" placeholder="Difficulty grade" name="difficulty" required>

           <label for="difficulty"><b>hard</b></label>
           <input type="radio" placeholder="Difficulty grade" name="difficulty" required>

           <label for="distance"></label>
           <input type="text" placeholder="Hike distance" name="distance" required>

           <label for="duration">Hike's duration</label>
           <input type="time" placeholder="Hike duration" name="duration" required>

           <label for="elevation">Hike elevation</label>
           <input type="text" placeholder="Elevation gain" name="elevation" required>
           <button type="submit" class="btn">ADD</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
         </form>
        </div>
    </header>
    <div class="container-box">
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
</div>
</body>
<script>
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  function openForm() {
  document.getElementById("myForm").style.display = "block";
  }
 </script>
</html>
<?php
require_once './components/footer.php'
?>