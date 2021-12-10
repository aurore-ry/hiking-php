<?php
require_once './components/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="includes/login.inc.php" method="post"> 
        <input type="text" name="username" placeholder="username"> <br>
        <input type="password" name="password" placeholder="password"> <br>
    <button type="submit" name="submit">log In</button>
    </form>
    <?php
if (isset($_GET["error"])) {
   if ($_GET["error"] == "emptyinput") {
    echo "<p>Fill in all the fields!</p>";
   } else if ($_GET["error"] == "wronglogin") {
    echo "<p>Enter a valid username or password!</p>";
   } else if ($_GET["error"] == "notlogged") {
    echo "<p>You need to be logged to access to \"My Hikings\"</p>";
    }
}
?>
</body>
</html>

<?php
require_once './components/footer.php'
?>