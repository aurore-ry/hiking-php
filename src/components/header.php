<?php
if (!isset($_SESSION["username"])) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <img src="../icons/logo.jpg" alt="Hikingders">
            <ul>
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li>
                    <a href="../myhikings.php">My hikings</a>
                </li>
                <?php
                    if (isset($_SESSION["username"])) {
                        echo "<li><a href=' ../profile.php'>". $_SESSION["username"] ." connected</a></li>";
                        echo "<li><a href='../includes/logout.inc.php'>Logout</a></li>";
                    } else {
                        echo "<li><a href='../signup.php'>Signup</a></li>";
                        echo "<li><a href='../login.php'>Login</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
</body>
</html>