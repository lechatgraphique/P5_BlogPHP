<?php


namespace App\Controller;


use App\Render\Twig;


class AdminController
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            header("Location: /");
            return;

        } else {
            header("Location: /");
            return;
        }

        if($user->getRole() != "ADMINISTRATOR") {
            header("Location: /");
            return;

        }
    }
}