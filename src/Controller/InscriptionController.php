<?php


namespace App\Controller;


use App\Render\Twig;

class InscriptionController extends Twig
{
    public function index()
    {
        echo $this->twig->render('frontend/inscription/index.twig', []);
    }
}