<?php
/**
 * Classe di connessione al database.
 * Base MVC di @filippofinke.
 */
namespace Libs;

class Database
{
    private static $connection = null;

    public static function get()
    {
        if (self::$connection === null) {
            if (SQLITE === null) {
                self::$connection = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PASS);
            } else {
                self::$connection = new \PDO("sqlite:".SQLITE);
            }
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}
