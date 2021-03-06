<?php
session_start();
require_once 'includes/newhike.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>New Hike</title>
    <link rel="stylesheet" href="/styles/signup.css">
</head>
<body>
    <?php
    require_once 'components/header.php';
    ?>
    <div class="form">
        <h1>Add a new hike</h1>
        <form action="/newhike" method="post">
        <label class="form-label" for="name">Name</label>
        <input class="form-input" type="text" name="name" placeholder="Name"> <br>
        <label class="form-label" for="difficulty">Difficulty</label>
        <input class="form-input" type="text" name="difficulty" placeholder="Difficulty"> <br>
        <label class="form-label" for="distance">Distance</label>
        <input class="form-input" type="text" name="distance" placeholder="Distance"> <br>
        <label class="form-label" for="duration">Duration</label>
        <input class="form-input" type="time" name="duration" placeholder="Duration"> <br>
        <label class="form-label" for="elevation">Elevation</label>
        <input class="form-input" type="text" name="elevation" placeholder="Elevation"> <br>
        
        <?php
            if (isset($_GET["error"])) {
              echo  '<div class="error">';
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all the fields!</p>";  
                echo '</div>';
            }
        }
        ?>
        <button class="sign-in" type="submit" name="submit">Add hike</button>
        </form>
    </div>

<?php
require_once 'components/footer.php'
?>
</body>
</html>