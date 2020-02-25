<?php


namespace App\Controller;


use App\Libs\Auth;
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
        if(Auth::user()->getRole() != 'ADMINISTRATOR') {
            header("Location: /");
            return;
        }

        echo $this->twig->getTwig()->render('backend/dashboard/index.twig', []);
    }
}