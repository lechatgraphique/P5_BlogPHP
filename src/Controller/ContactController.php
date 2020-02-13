<?php


namespace App\Controller;


use App\Render\Twig;

class ContactController
{
    public function index()
    {
        $twig = Twig::run();
        echo $twig->render('frontend/contact/index.twig', []);
    }
}