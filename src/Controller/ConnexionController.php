<?php


namespace App\Controller;


use App\Render\Twig;

class ConnexionController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        echo $this->twig->getTwig()->render('frontend/login/index.twig', []);
    }
}