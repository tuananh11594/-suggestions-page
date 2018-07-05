<?php

$db_config_path = $_SERVER['DOCUMENT_ROOT'].'/..';
if ( file_exists($db_config_path . '/local-config.php') )
    require $db_config_path . '/local-config.php';
elseif ( file_exists($db_config_path . '/stage-config.php') )
    require $db_config_path . '/stage-config.php';
elseif ( file_exists($db_config_path . '/prod-config.php') )
    require $db_config_path . '/prod-config.php';
else
    include_once $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

class Database {
    private static $host = DB_HOST;
    private static $dbName = DB_NAME;
    private static $username = DB_USER;
    private static $password = DB_PASSWORD;
    public static $con = null;

    public function __construct() {
        echo 'Not connect to db';
    }

    public static function connect() {
        if (self::$con == null) {
            try {
                self::$con = new PDO('mysql:host='.self::$host.';dbname='.self::$dbName, self::$username, self::$password);
                self::$con->exec("set names utf8");
            } catch (PDOException $ex) {
                die('Error: '.$ex->getMessage());
            }
        }
        return self::$con;
    }
    
    public static function disconnect() {
        self::$con = null;
    }

}

?>