<?php
/**
 * File principale.
 * Base MVC di @filippofinke.
 */
use Libs\Application;

session_start();
require __DIR__ . '/application/config/config.php';

if (CHECK_FOR_UPDATES) {
    $version = file_get_contents("version");
    if ($version < @file_get_contents("https://raw.githubusercontent.com/filippofinke/php-mvc/master/version")) {
        echo "A new version is avaiable, go to <a href='https://github.com/filippofinke/php-mvc/'>https://github.com/filippofinke/php-mvc/</a> to download it!";
        echo "<br>Or disable automatic updates check in the config.php file.";
        exit;
    }
}

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