<?php
/**
 * File di configurazione.
 * Base MVC di @filippofinke.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

define('URL', 'http://127.0.0.1/');

define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'db');
define('SQLITE', null);

$autoload_directories = array(
    "application/controllers/",
    "application/libs/",
    "application/models/"
);
