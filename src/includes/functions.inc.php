<?php

function emptyInputSignup($firstname, $lastname, $username, $email, $password, $confirm) {
    $result;
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $confirm) {
    $result;
    if ($password !== $confirm) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function usernameTaken($db, $username) {
    $result;
    try {
        $sql = "SELECT * FROM user WHERE username = :username;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: ../signup.php?error=stmtfailed');
    exit;
    }
    $usernameCheck = $stmt->rowCount();
    if ($usernameCheck > 0) {
        $result=true;
    } else {
        $result= false;
    }
    return $result;
}

function createUser($db, $lastname, $firstname, $username, $email, $password) {
    $result;
    try {
        $sql = "INSERT INTO user (lastname, firstname, username, email, password) VALUES (:lastname, :firstname, :username, :email, :password);";
        $stmt = $db->prepare($sql);
        
        $passwordhash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 14]);

        $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordhash, PDO::PARAM_STR);
        $stmt->execute();
        header("location: ../login.php?error=none");
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: ../signup.php?error=stmtfailed');
    exit;
    }
}

function emptyInputLogin($username, $password) {
    $result;
    if (empty($username) ||empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($db, $username, $password) {
    $usernameExists = usernameTaken($db, $username);

    if ($usernameExists === false) {
        header('Location: ../login.php?error=wronglogin');
        exit();
    }
    //
    try {
        $sql = "SELECT * FROM user WHERE username = :username;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: ../login.php?error=stmtfailed');
    exit;
    }
    $usernameCheck = $stmt->fetch(PDO::FETCH_ASSOC);

    //
    $passwordhashed = $usernameCheck["password"];
    $checkPassword = password_verify($password, $passwordhashed);

    if ($checkPassword === false) {
        header('Location: ../login.php');
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["username"] = $usernameCheck["username"];
        $_SESSION["id"] = $usernameCheck["id"];
        header("location: ../index.php");
        exit();
    }
}