<?php


namespace App\Controller;


use App\Render\Twig;

class ContactController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        $url = 'contact';
        echo $this->twig->getTwig()->render('frontend/contact/index.twig', [
            'url' => $url
        ]);
    }
}