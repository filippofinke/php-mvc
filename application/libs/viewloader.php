<?php
namespace Libs;

class ViewLoader
{
    public static function load($template)
    {
        require_once __DIR__ . '/../views/'.$template.'.php';
    }
}
