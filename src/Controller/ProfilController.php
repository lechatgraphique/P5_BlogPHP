<?php


namespace App\Controller;


use App\Entity\User;
use App\Libs\Auth;
use App\Libs\SessionFlash;
use App\Libs\UploadImage;
use App\Render\Twig;
use App\Repository\UserRepository;

class ProfilController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index(array $params)
    {
        $id = (int)$params['id'];

        if(!Auth::user()){
            header("Location: /");
            return;
        }

        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        if(Auth::user()->getId() != $user->getId()) {
            header("Location: /");

            return;
        }

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('frontend/profil/formEdit.twig', [
            'user' => $user,
            'flash' => $flash
        ]);
    }
    public function update(array $params)
    {

        $id = (int)$params['post']['id'];

        if(!Auth::user()){
            header("Location: /");
            return;
        }

        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        if(Auth::user()->getId() != $user->getId()) {
            header("Location: /");
            return;
        }

        $params['avatar'] = $params['post']['avatar'];
        $password = $params['post']['password'];

        $currentUser = $userRepository->find($id);

        $userEntity = new User();
        $user = $userEntity->setId($id)
            ->setUsername($params['post']['username'])
            ->setLastName($params['post']['last_name'])
            ->setFirstName($params['post']['first_name'])
            ->setAvatar($params['avatar']['name'])
            ->setDisabled($currentUser->getDisabled())
            ->setRole($currentUser->getRole())
            ->setPassword($currentUser->getPassword());



        if(!empty($password)) {
            $verifyPassword = password_verify($password, $currentUser->getPassword());

            if($verifyPassword) {
                if(empty($params['post']['new_password'])) {
                    SessionFlash::sessionFlash("danger", "Nouveau mot de passe vide.");
                    header("Location: /profil/{$user->getId()}");
                    return;
                }
                if($params['post']['new_password'] === $params['post']['confirm_password']) {
                    $password = password_hash($params['post']['new_password'], PASSWORD_DEFAULT);
                    $user->setPassword($password);
                } else {
                    SessionFlash::sessionFlash("danger", "les mots de passe saisis ne sont pas identiques.");
                    header("Location: /profil/{$user->getId()}");
                    return;
                }
            } else {
                SessionFlash::sessionFlash("danger", "Ancien mot de passe incorrect. Impossible de changer votre mot de passe.");
                header("Location: /profil/{$user->getId()}");
                return;
            }
        }

        if(empty($user->getAvatar())) {
            $user->setAvatar($currentUser->getAvatar());
        }

        if($user->getAvatar() != $currentUser->getAvatar()) {
            $uploadImage = new UploadImage(
                $params['avatar']['name'],
                $params['avatar']['size'],
                $params['avatar']['tmp_name'],
                $params['avatar']['type']
            );
            if($uploadImage->getErrors()) {
                SessionFlash::sessionFlash("danger", $uploadImage->getErrors());
                header("Location: /profil/{$user->getId()}");
                return;
            }
        }

        $userRepository->update($user);

        $_SESSION['user'] = serialize($user);


        $title = $user->getUsername();

        SessionFlash::sessionFlash("success", "La mise à jour de l'utilisateur ($title) a réussie.");
        header("Location: /profil/{$user->getId()}");
    }
}