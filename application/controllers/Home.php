<?php
/**
 * Controller di esempio Home.
 * Base MVC di @filippofinke.
 */
namespace Controllers;

use Libs\Application as Application;
use Libs\ViewLoader as ViewLoader;
use Libs\Auth as Auth;
use Models\Books as Books;
use Models\Users as Users;

class Home
{
    public function index()
    {
        if (!Auth::isAuthenticated()) {
            ViewLoader::load('home/index');
        } else {
            Application::redirect("/home/home");
        }
    }

    public function home()
    {
        if (!Auth::isAuthenticated()) {
            Application::redirect("/home/index");
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
        Application::redirect("/home/home");
    }

    public function logout()
    {
        Auth::logout();
        Application::redirect("/home/index");
    }
}
