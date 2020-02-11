<?php


namespace App\Connector;

use \PDO;

class DBConnexion
{
    private static $db;

    public static function dbConnect()
    {
        require '../config/config.php';

        $params = [
            'host' => DB_HOST,
            'dbname' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS
        ];

        if(self::$db === null) {

            $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}";

            $db = new PDO($dsn, $params['username'], $params['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }
}