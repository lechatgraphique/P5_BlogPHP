<?php


namespace App\Controller;


use App\Render\Twig;

class InscriptionController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        echo $this->twig->getTwig()->render('frontend/inscription/index.twig', []);
    }
}