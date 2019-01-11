<?php
namespace Controllers;
use Libs\ViewLoader as ViewLoader;

class ErrorPage {

  public function error404()
  {
    ViewLoader::load('templates/404');
  }

  public function error500()
  {
    ViewLoader::load('templates/500');
  }

}
