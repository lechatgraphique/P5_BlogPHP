<?php


namespace App\Controller;


use App\Render\Twig;

class InscriptionController
{
    public function index()
    {
        $twig = Twig::run();
        echo $twig->render('frontend/inscription/index.twig', []);
    }
}