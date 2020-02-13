<?php


namespace App\Controller;


use App\Render\Twig;

class ConnexionController
{
    public function index()
    {
        $twig = Twig::run();
        echo $twig->render('frontend/login/index.twig', []);
    }
}