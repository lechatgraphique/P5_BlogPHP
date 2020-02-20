<?php


namespace App\Controller;


use App\Entity\User;
use App\Libs\SessionFlash;
use App\Libs\UploadImage;
use App\Render\Twig;
use App\Repository\UserRepository;

class InscriptionController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            echo $this->twig->getTwig()->render('frontend/inscription/index.twig', []);

        } else {
            header("Location: /");
            return;
        }
    }

    public function create(array $params)
    {

        $user = new User();
        $user->setUsername($params['post']['username'])
            ->setLastName($params['post']['last_name'])
            ->setFirstName($params['post']['first_name'])
            ->setDisabled(0)
            ->setRole("USER");

        if($params['post']['password'] === $params['post']['confirm_password']) {
            $password = password_hash($params['post']['password'], PASSWORD_DEFAULT);
            $user->setPassword($password);
        } else {
            SessionFlash::sessionFlash("danger", "les mots de passe saisis ne sont pas identiques.");
            header("Location: /inscription");
            return;
        }

        $userRepository = new UserRepository();

        $users = $userRepository->findAll();

        foreach ($users as $currentUser ) {
            if($user->getUsername() === $currentUser->getUsername()) {
                SessionFlash::sessionFlash("danger", "Le nom d'utilisateur {$user->getUsername()} existe déjà.");
                header("Location: /inscription");
                return;
            }
        }

        $_SESSION['user'] = serialize($user);

        $title = $user->getUsername();

        $userRepository = new UserRepository();
        $userRepository->create($user);

        SessionFlash::sessionFlash("success", "L'utilisateur ($title) a bien été enregistré.");

        header('Location: /inscription');
    }
}