<?php

namespace MyControl\Controllers;

class DatabaseController {
    private static  $hostname = "localhost";
    private static string $dbname = "mycontrolpanel";
    private static string $username = "root";
    private static string $password = "";
    private static string $charset = "utf8";

    private static $connection = null;

    public static function getConnection():\PDO{
        if(self::$connection == null){
            $dns = "mysql:hostname=". self::$hostname . ";dbname=" . self::$dbname . ";charset=" .self::$charset;
            self::$connection = new \PDO($dns, self::$username, self::$password);
        }

        return self::$connection;
    }
}

