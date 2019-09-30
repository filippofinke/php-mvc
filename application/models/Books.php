<?php
/**
 * Esempio di classe model.
 * Base MVC di @filippofinke.
 */
namespace Models;

class Books
{
    private static $books = array(
        array('name' => 'Book 1', 'description' => 'A nice book!'),
        array('name' => 'Book 2', 'description' => 'A bad book!')
    );

    public static function get()
    {
        return self::$books;
    }
}
