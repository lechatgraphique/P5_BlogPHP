<?php


namespace App\Controller;


use App\Render\Twig;

class ContactController extends  Twig
{
    public function index()
    {
        echo $this->twig->render('frontend/contact/index.twig', []);
    }
}