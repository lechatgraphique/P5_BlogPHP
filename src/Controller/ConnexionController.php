<?php


namespace App\Controller;


use App\Render\Twig;
use App\Repository\UserRepository;

class ConnexionController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            echo $this->twig->getTwig()->render('frontend/login/index.twig', []);

        } else {
            header("Location: /");
            return;
        }

    }
    public function login(array $params)
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            echo $this->twig->getTwig()->render('frontend/login/index.twig', []);

        } else {
            header("Location: /");
            return;
        }
        
    }

}