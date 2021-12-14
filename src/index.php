<?php
include_once 'components/starter.php';
require_once "./includes/db.inc.php";
  
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
    <title>Hikingder</title>
</head>
<body>
  <?php
  include_once './components/header.php';
  ?>
    <h1>Main Page</h1>
   
  <?php
  require_once './components/footer.php'
  ?>
</body>
</html>

