<?php
/**
 * File principale.
 * Base MVC di @filippofinke.
 */
use Libs\Application;

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

$app->addMiddleware('Home', 'index', function() {
    echo "<h1>Before middleware!</h1>";
});

$app->run();