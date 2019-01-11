<?php
use Libs\Application as Application;
// carico il file di configurazione
require 'application/config/config.php';

// carico le classi dell'applicazione
require 'application/libs/application.php';

// faccio partire l'applicazione
$app = new Application();
