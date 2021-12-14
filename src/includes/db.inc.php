<?php
class MyPDO extends PDO
{
    public function __construct()
    {
        $host = $_ENV['DATABASE_HOST'];
        $port = $_ENV['DATABASE_PORT'];
        $user = $_ENV['DATABASE_USER'];
        $pass = $_ENV['DATABASE_PASSWORD'];
        $db_name = $_ENV['DATABASE_NAME'];
        parent::__construct('mysql://host=' . $host . ';port=' . $port . ';dbname=' . $db_name, $user, $pass);
    }
}
?>