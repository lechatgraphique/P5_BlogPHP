<?php


namespace App\Controller;


use App\Libs\Auth;
use App\Libs\SessionFlash;
use App\Render\Twig;
use App\Repository\UserRepository;

class ConnexionController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        $flash = SessionFlash::renderSessionFlash();

        if(Auth::user()) {
            header("Location: /");
        } else {
            echo $this->twig->getTwig()->render('frontend/login/index.twig', [
                'flash' => $flash
            ]);
        }
    }

    public function login(array $params)
    {

        $userRepository = new UserRepository();
        $user = $userRepository->findUser($params['post']['username']);

        if($user->getDisabled() == 1) {
            SessionFlash::sessionFlash("danger", "Votre compte a été suspendu.");
            header("Location: /connexion");
            return;
        }


        if($user && password_verify($params['post']['password'], $user->getPassword())) {
            Auth::login($user);
            header("Location: /");
            return;
        } else {
            SessionFlash::sessionFlash("danger", "Identifants incrorrecte.");
            header("Location: /connexion");
            return;
        }
    }

    public function disconnect()
    {
       Auth::logoff();
       header("Location: /");
    }
}