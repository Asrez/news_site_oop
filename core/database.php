<?php

class database
{
    public static $conn = "";
    
    public function __construct()
    {
        try {
            self::$conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME,DB_USER, DB_PASS);
            // set the PDO error mode to exception
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function a()
    {
        echo "aaaa";
    }

}
