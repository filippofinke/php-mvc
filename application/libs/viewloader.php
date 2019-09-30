<?php
/**
 * Classe utilizzata per renderizzare le view.
 * Base MVC di @filippofinke.
 */
namespace Libs;

class ViewLoader
{
    public static function load($template, $args = null)
    {
        if (gettype($args) == "array") {
            foreach ($args as $name => $value) {
                $$name = $value;
            }
        }
        require __DIR__ . '/../views/'.$template.'.php';
    }
}
