<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
    } 
elseif (isset($_SESSION["username"])){
    require_once './includes/db.inc.php';
    $db = new MyPDO();

    try {
        $sql = "SELECT id,lastname, firstname, username, email FROM users WHERE id = :id;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: ../signup.php?error=stmtfailed');
    exit;
    }
    $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $currentUser['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./styles/signup.css">
</head>
<body>
    <?php
    require_once './components/header.php';
    ?>
<div class="form">
    <h1>Modify information</h1>
    <form action="includes/profile.inc.php" method="post">
    <label class="form-label" for="firstname">First Name</label>
    <input class="form-input" type="text" name="firstname" value="<?php echo "$currentUser[firstname]";?>"> <br>
    <label class="form-label" for="lastname">Last Name</label>
    <input class="form-input" type="text" name="lastname" value="<?php echo "$currentUser[lastname]";?>"> <br>
    <label class="form-label" for="email">Email</label>
    <input class="form-input" type="text" name="email" value="<?php echo "$currentUser[email]";?>"> <br>
    <label class="form-label" for="username">Username</label>
    <input class="form-input" type="text" name="username" value="<?php echo "$currentUser[username]";?>"> <br>
    <label class="form-label" for="password">Change password</label>
    <input class="form-input" type="password" name="password" placeholder="password"> <br>
    <label class="form-label" for="confirm">Confirm password</label>
    <input class="form-input" type="password" name="confirm" placeholder="confirm password"><br>
    <input type="hidden" name="currentUser" value="<?php echo "$id" ?>">
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
    <button class="sign-in" type="submit" name="submit">update profile</button>
</form>
</div>

<?php
require_once './components/footer.php'
?>
</body>
</html>

