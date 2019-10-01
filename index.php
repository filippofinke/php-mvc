<?php
/**
 * File principale.
 * Base MVC di @filippofinke.
 */

session_start();
require __DIR__ . '/application/config/config.php';

foreach($autoload_directories as $directory) {
    $files = glob($directory.'*.php');
    foreach($files as $file) {
        $path = __DIR__.'/'.$file;
        require_once $path;
    }
}

$app = new Libs\Application();
$app->setDefaultController('Home');
$app->run();