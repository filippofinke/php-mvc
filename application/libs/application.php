<?php
namespace Libs;
use Controller;

session_start();
require 'viewloader.php';

class Application
{
    private $url_controller = null;
    private $url_action = null;
    private $url_parameter = [];

    public function __construct()
    {
        $this->init();
        if (file_exists('./application/controller/' . $this->url_controller . '.php')) {
            require './application/controller/' . $this->url_controller . '.php';
            $controller = "Controller\\".$this->url_controller;
            $this->url_controller = new $controller();
            if (method_exists($this->url_controller, $this->url_action)) {
                call_user_func_array(array($this->url_controller, $this->url_action), $this->url_parameter);
            } else {
                $this->url_controller->index();
            }
        } else {
            require './application/controller/errorpage.php';
            $error = new Controller\ErrorPage();
            $error->error404();
        }
    }

    private function init()
    {
        $url = $_SERVER['REQUEST_URI'];
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
}
