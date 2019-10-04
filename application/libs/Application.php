<?php
/**
 * Applicazione principale.
 * Base MVC di @filippofinke.
 */
namespace Libs;

use Controllers;

class Application
{
    private $url_controller = null;
    private $url_action = null;
    private $url_parameter = [];
    private $default_controller = null;
    private $middlewares = [];

    public function addMiddleware($controller, $route, $function) {
       $this->middlewares[strtolower($controller)][$route] = $function;
    }

    public function setDefaultController($controller) {
        $controller = '\Controllers\\'.$controller;
        if (class_exists($controller)) {
            $this->default_controller = new $controller();
        } else {
            trigger_error("Controller $controller not found!");
        }
    }

    public static function redirect($to)
    {
        header("Location: ".URL.$to);
        exit;
    }

    public function __construct()
    {
        $this->init();
    }

    public function run() {
        $controller_name = $this->url_controller;
        $controller = '\Controllers\\'.($this->url_controller);
        if (class_exists($controller)) {
            $this->url_controller = new $controller();
            if(isset($this->middlewares[$controller_name][$this->url_action])) {
                $this->middlewares[$controller_name][$this->url_action]();
            }
            if (method_exists($this->url_controller, $this->url_action)) {
                call_user_func_array(array($this->url_controller, $this->url_action), $this->url_parameter);
            } else if(method_exists($this->url_controller, 'index') && $this->url_action == null) {
                $this->url_controller->index();
            } else {
                Controllers\ErrorPage::error404();
            }
        } else {
            if($this->url_controller == null && $this->default_controller != null && method_exists($this->default_controller, 'index')) {
                $this->default_controller->index();
            } else {
                Controllers\ErrorPage::error404();
            }
        }
    }

    private function init()
    {
        set_error_handler(array($this, 'errorHandler'));

        $full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = '/'.str_replace(URL, "", $full_url);
        $url = substr($url, 1, strlen($url));
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        $this->url_controller = (isset($url[0]) ? $url[0] : null);
        $this->url_action = (isset($url[1]) ? $url[1] : null);
        if (count($url) > 2) {
            for ($i = 2; $i < count($url); $i++) {
                $this->url_parameter[] = $url[$i];
            }
        }
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        ob_end_clean();
        echo "<h1>Errore!</h1>";
        echo "<h3><b>Messaggio di errore:</b> [$errno] $errstr</h3><br>";
        echo "Riga: <b>$errline</b><br>File: <b>$errfile</b><br>";
        exit(0);
    }
}
