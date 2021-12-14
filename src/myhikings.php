<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ../login.php?error=notlogged');
        exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Hikings</title>
</head>
<body>
    <?php
    require_once './components/header.php';
    ?>

    <h1>My Hikings</h1>
    <?php
    require_once './components/footer.php'
    ?>
</body>
</html>

