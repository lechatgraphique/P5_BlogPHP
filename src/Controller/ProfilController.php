<?php


namespace App\Controller;


use App\Libs\SessionFlash;
use App\Render\Twig;
use App\Repository\UserRepository;

class ProfilController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        //reprendre le template dans template/dashboard/user/formEdit.twig
    }
}