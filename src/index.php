<?php
  require_once "./db.php";
  $db = new MyPDO();
  $stmt = $db->prepare('SELECT * FROM hiking');
  $stmt->execute();

  $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  print_r($res)
  
  ?>