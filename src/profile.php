<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
}
require_once './components/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <h1>Signup</h1>
    <form action="includes/profile.inc.php" method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" value="<?php echo ""> <br>
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" placeholder="lastname"> <br>
    <label for="email">Email</label>
    <input type="text" name="email" placeholder="email"> <br>
    <label for="username">Choose a username</label>
    <input type="text" name="username" placeholder="username"> <br>
    <label for="password">Choose a password</label>
    <input type="password" name="password" placeholder="password"> <br>
    <label for="confirm">Confirm password</label>
    <input type="password" name="confirm" placeholder="confirm password"><br>
    <button type="submit" name="submit">Sign In</button>
</form>
<?php
if (isset($_GET["error"])) {
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
}
?>
</body>
</html>

<?php
require_once './components/footer.php'
?>