<?php
require_once "db.inc.php";
$db = new MyPDO();
function emptyInputSignup($firstname, $lastname, $username, $email, $password, $confirm) {
    $result;
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputUpdate($firstname, $lastname, $username, $email, $password, $confirm) {
    $result;
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email)) {
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
        $sql = "SELECT * FROM users WHERE username = :username;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /signup?error=stmtfailed');
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
    try {
        $sql = "INSERT INTO users (lastname, firstname, username, email, password) VALUES (:lastname, :firstname, :username, :email, :password);";
        $stmt = $db->prepare($sql);
        
        $passwordhash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 14]);

        $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordhash, PDO::PARAM_STR);
        $stmt->execute();
        header("location: /login?error=none");
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /signup?error=stmtfailed');
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
        header('Location: /login?error=wronglogin');
        exit();
    }
    //
    try {
        $sql = "SELECT * FROM users WHERE username = :username;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /login?error=stmtfailed');
    exit;
    }
    $usernameCheck = $stmt->fetch(PDO::FETCH_ASSOC);

    //
    $passwordhashed = $usernameCheck["password"];
    $checkPassword = password_verify($password, $passwordhashed);

    if ($checkPassword === false) {
        header('Location: /login?error=wronglogin');
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["username"] = $usernameCheck["username"];
        $_SESSION["id"] = $usernameCheck["id"];
        header("location: /");
        exit();
    }
}

function updateUser($db, $lastname, $firstname, $username, $email, $password, $userId) {
    
    try {
        if (!empty($password)) {
        $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname, username = :username, email = :email, password = :password WHERE id = :userId;";
        } else {
        $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname, username = :username, email = :email WHERE id = :userId;";
        }
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        if (!empty($password)){
            $passwordhash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 14]);
            $stmt->bindParam(":password", $passwordhash, PDO::PARAM_STR);
        }
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['username'] = $username;
        header("location: /?error=none");
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /profile?error=stmtfailed');
    exit;
    }
}

function addHike($db, $name, $difficulty, $distance, $duration, $elevation) {
    try {
        $sql = "INSERT INTO hiking (name, difficulty, distance, duration, elevation) VALUES (:name, :difficulty, :distance, :duration, :elevation);";
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":difficulty", $difficulty, PDO::PARAM_STR);
        $stmt->bindParam(":distance", $distance, PDO::PARAM_STR);
        $stmt->bindParam(":duration", $duration, PDO::PARAM_STR);
        $stmt->bindParam(":elevation", $elevation, PDO::PARAM_STR);
        $stmt->execute();
        header("location: /?error=none");
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /newhike?error=stmtfailed');
    exit;
    }
}

function addLike($db, $hikingid, $userId) {
    try {
        $sql = "INSERT INTO myhikings (user, hiking) VALUES (:user, :hiking);";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":user", $userId, PDO::PARAM_STR);
        $stmt->bindParam(":hiking", $hikingid, PDO::PARAM_STR);
        $stmt->execute();
        header("location: /?error=none");
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /?error=stmtfailed');
    exit;
    }
}

function removeLike($db, $hikingid, $userId) {
    try {
        $sql = "DELETE FROM myhikings WHERE user = :user AND hiking = :hiking;";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":user", $userId, PDO::PARAM_STR);
        $stmt->bindParam(":hiking", $hikingid, PDO::PARAM_STR);
        $stmt->execute();
        header("location: /myhikings?error=none");
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
        header('location: /myhikings?error=stmtfailed');
    exit;
    }
}