<?php
require_once 'components/starter.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="/styles/signup.css">
</head>
<body>
    <?php
    require_once 'components/header.php';
    ?>
    <div class="form">
        <h1>Sign up</h1>
        <form action="includes/signup.inc.php" method="post">
        <label class="form-label" for="firstname">First Name</label>
        <input class="form-input" type="text" name="firstname" placeholder="First name"> <br>
        <label class="form-label" for="lastname">Last Name</label>
        <input class="form-input" type="text" name="lastname" placeholder="Last name"> <br>
        <label class="form-label" for="email">Email</label>
        <input class="form-input" type="text" name="email" placeholder="Email"> <br>
        <label class="form-label" for="username">Choose a username</label>
        <input class="form-input" type="text" name="username" placeholder="Username"> <br>
        <label class="form-label" for="password">Choose a password</label>
        <input class="form-input" type="password" name="password" placeholder="Password"> <br>
        <label class="form-label" for="confirm">Confirm password</label>
        <input class="form-input" type="password" name="confirm" placeholder="Confirm password"><br>
        
        <?php
            if (isset($_GET["error"])) {
              echo  '<div class="error">';
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all the fields!</p>";
            } else if ($_GET["error"] == "invaliduser") {
                echo "<p>Choose a valid username!</p>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<p>Please enter a valid email address!</p>";
            } else if ($_GET["error"] == "passwordnotmatch") {
                echo "<p>You made an error while confirming your password! Please retry!</p>";
            } else if ($_GET["error"] == "usernametaken") {
                echo "<p>Choose an other username! This one is not available!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong! Please retry!</p>";
            } else if ($_GET["error"] == "invaliduser") {
                echo "<p>Choose an other username! This one is not available!</p>";
            }   
                echo '</div>';
            }
        ?>
        <button class="sign-in" type="submit" name="submit">Sign In</button>
        </form>
    </div>

<?php
require_once 'components/footer.php'
?>
</body>
</html>