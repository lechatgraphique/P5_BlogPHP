<?php


namespace App\Controller;


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
        echo $this->twig->getTwig()->render('backend/dashboard/index.twig', []);
    }
}