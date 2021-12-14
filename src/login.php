<?php
require_once './components/starter.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./styles/signup.css">
</head>
<body>
<?php
require_once './components/header.php';
?>
 <img src="./icons/logo.jpg" alt="logo">
<div class="form">
        <h1>Login</h1>
        <form action="includes/login.inc.php" method="post">
        <label class="form-label" for="username">Username</label>
        <input class="form-input" type="text" name="username" placeholder="username"> <br>
        <label class="form-label" for="password">Password</label>
        <input class="form-input" type="password" name="password" placeholder="password"> <br>
        <?php
            if (isset($_GET["error"])) {
                echo  '<div class="error">';
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all the fields!</p>";
            } else if ($_GET["error"] == "wronglogin") {
                echo "<p>Enter a valid username or password!</p>";
            } else if ($_GET["error"] == "notlogged") {
                echo "<p>You need to be logged to access to \"My Hikings\"</p>";
                }
                echo '</div>';
            }
        ?>
        <button class="sign-in" type="submit" name="submit">log In</button>
        </form>
</div>

<?php
require_once './components/footer.php'
?>
</body>
</html>

