<?php
/**
 * Esempio di classe Model con database.
 * Base MVC di @filippofinke.
 */
namespace Models;
use Libs\Database;

class Users
{
    public static function get()
    {
        /*
        Esempio:
        $query = Database::get()->prepare("SELECT * FROM USERS");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);*/
        return array();
    }
}
