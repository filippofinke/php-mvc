<?php
/**
 * Controller di esempio Home.
 * Base MVC di @filippofinke.
 */
namespace Controllers;

use Libs\Application;
use Libs\ViewLoader;
use Libs\Auth;
use Models\Books;
use Models\Users;

class Home
{
    public function index()
    {
        if (!Auth::isAuthenticated()) {
            ViewLoader::load('home/index');
        } else {
            Application::redirect("home/home");
        }
    }

    public function home()
    {
        if (!Auth::isAuthenticated()) {
            Application::redirect("home/index");
        } else {
            $books = Books::get();
            $users = Users::get();
            ViewLoader::load('home/home', array(
                'books' => $books,
                'users' => $users
            ));
        }
    }

    public function login()
    {
        Auth::auth();
        Application::redirect("home/home");
    }

    public function logout()
    {
        Auth::logout();
        Application::redirect("home/index");
    }
}
