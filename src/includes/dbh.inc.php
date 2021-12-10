<?php
class MyPDO extends PDO
{
    public function __construct($file = './mysetting.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
        $dns = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'];
        parent::__construct($dns, $settings['database']['username'], $settings['database']['pswd']);
    }
}

// define("HOST", "mysql");
// define("DB", "users");
// define("PORT", "3306");
// define("LOGIN", "root");
// define("PASSWORD", "root");

// try {

//     // We create a new instance of the class PDO
//     $db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);

//     //We want any issues to throw an exception with details, instead of a silence or a simple warning
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch(Exception $e) {
//     // We intantiate an Exception object in $e so we can use methods within this object to display errors nicely
//     echo $e->getMessage();
//     exit;
// }