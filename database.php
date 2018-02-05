<?php
class Database {
    private static $db_name = "crud_php";
    private static $db_host = "localhost";
    private static $db_username = "root";
    private static $db_password = "mysql";

    private static $conn = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if (null == self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=".self::$db_host.";" . "dbname=".self::$db_name, self::$db_username, self::$db_password);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disconnect() {
        self::$conn = null;
    }
}
?>