<?php
abstract class Connection
{
    private static $conn;

    public static function getConn()
    {
        if (self::$conn == null) {
            self::$conn = new PDO('mysql: host=127.0.0.1; dbname=bd_site_teste;', 'rafaela', 'oie1232');
        }

        return self::$conn;
    }
}
