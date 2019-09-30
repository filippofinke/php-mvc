<?php
/**
 * Esempio di classe di autenticazione.
 * Base MVC di @filippofinke.
 */
namespace Libs;

class Auth
{
    public static function isAuthenticated()
    {
        if (isset($_SESSION["auth"])) {
            return true;
        }
        return false;
    }

    public static function auth()
    {
        $_SESSION["auth"] = true;
    }

    public static function logout()
    {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        session_destroy();
    }
}
