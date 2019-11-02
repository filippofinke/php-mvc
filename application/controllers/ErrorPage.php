<?php
/**
 * Controller per gli errori.
 * Base MVC di @filippofinke.
 */
namespace Controllers;

use Libs\ViewLoader;

class ErrorPage
{
    public static function error404()
    {
        ViewLoader::load('errors/404');
    }
}
