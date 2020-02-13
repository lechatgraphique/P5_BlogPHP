<?php


namespace App\Controller;


use App\Render\Twig;

class ConnexionController extends Twig
{
    public function index()
    {
        echo $this->twig->render('frontend/login/index.twig', []);
    }
}