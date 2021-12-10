<?php 
  require_once "./db.php";
   
  $dbr = new MyPDO();
         
 function getHike($dbr) {
 $qry = "{$_GET['id']}"; try {
 $searchData =  $dbr->prepare('SELECT * FROM hiking WHERE id');
    $searchData->execute([$qry]);
   } catch (PDOException $e) {
     die("Bad way :" . $e->getMessage());
   }
   $resultData = $searchData->fetch();
   

   return 
   ?> <strong>Name : <?php echo $searchData["name"];?></strong> <?php
   ?> <p>Place : <?php echo $searchData["name"];?></p> <?php
   ?> <p>Difficulty : <?php echo $searchData["difficulty"];?></p> <?php 
   ?> <p>Distance : <?php echo $searchData["distance"];?></p> <?php  
   ?> <p>Duration : <?php echo $searchData["duration"];?></p> <?php 
   ?> <p>Elevation : <?php echo $searchData["elevation"];?></p> <?php 
        
 }
  
?>