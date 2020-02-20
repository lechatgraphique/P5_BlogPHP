<?php


namespace App\Controller;


use App\Entity\User;
use App\Libs\Pagination;
use App\Libs\SessionFlash;
use App\Libs\UploadImage;
use App\Render\Twig;
use App\Repository\UserRepository;

class AdminUserController
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index(array $params)
    {
        $page = $params['get']['page'];

        $userRepository = new UserRepository();
        $users = $userRepository->findAll();

        // Test
        $user = $userRepository->find(1);
        $_SESSION['user'] = serialize($user);

        $countUsers = count($userRepository->findAll());
        $pagination = null;

        if($page === null){
            $page = 1;
        }

        if($countUsers > 5) {
            $PaginationFinal = new Pagination();
            $PaginationFinal->setCurrentPage($page);
            $PaginationFinal->setInnerLinks(2);
            $PaginationFinal->setNbElementsInPage(5);
            $PaginationFinal->setNbMaxElements($countUsers);
            $PaginationFinal->setUrl("/dashboard/utilisateurs?page={i}");

            $pagination = $PaginationFinal->renderBootstrapPagination();
            $users = $PaginationFinal->setContent($users);
        }

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/user/index.twig', [
            "users" => $users,
            "flash" => $flash,
            "pagination" => $pagination
        ]);
    }

    public function formCreate(array $params)
    {
        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/user/formCreate.twig', [
            "flash" => $flash,
        ]);
    }

    public function formEdit(array $params)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->find($params['id']);

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/user/formEdit.twig', [
            "user" => $user,
            "flash" => $flash
        ]);
    }

    public function create(array $params)
    {
        $params['avatar'] = $params['post']['avatar'];

        $uploadImage = new UploadImage(
            $params['avatar']['name'],
            $params['avatar']['size'],
            $params['avatar']['tmp_name'],
            $params['avatar']['type']
        );

        if(empty($params['avatar']['name'])) {
            SessionFlash::sessionFlash("danger", "Vous devez uploader une image de profil.");
            header("Location: /dashboard/utilisateurs/form-create");
            return;
        }

        if($uploadImage->getErrors()) {
            SessionFlash::sessionFlash("danger", $uploadImage->getErrors());
            header("Location: /dashboard/utilisateurs/form-create");
            return;
        }

        $user = new User();
        $user->setUsername($params['post']['username'])
            ->setLastName($params['post']['last_name'])
            ->setFirstName($params['post']['first_name'])
            ->setDisabled($params['post']['disabled'])
            ->setRole($params['post']['role'])
            ->setAvatar($params['avatar']['name']);

        if($params['post']['password'] === $params['post']['confirm_password']) {
            $password = password_hash($params['post']['password'], PASSWORD_DEFAULT);
            $user->setPassword($password);
        } else {
            SessionFlash::sessionFlash("danger", "les mots de passe saisis ne sont pas identiques.");
            header("Location: /dashboard/utilisateurs/form-create");
            return;
        }

        $userRepository = new UserRepository();

        $users = $userRepository->findAll();

        foreach ($users as $currentUser ) {
            if($user->getUsername() === $currentUser->getUsername()) {
                SessionFlash::sessionFlash("danger", "Le nom d'utilisateur {$user->getUsername()} existe déjà.");
                header("Location: /dashboard/utilisateurs/form-create");
                return;
            }
        }

        $title = $user->getUsername();

        $userRepository = new UserRepository();
        $userRepository->create($user);

        SessionFlash::sessionFlash("success", "L'utilisateur ($title) a bien été enregistré.");

        header('Location: /dashboard/utilisateurs');
    }

    public function update(array $params)
    {
        $id = (int)$params['post']['id'];
        $params['avatar'] = $params['post']['avatar'];
        $password = $params['post']['password'];

        $userRepository = new UserRepository();
        $currentUser = $userRepository->find($id);

        $userEntity = new User();
        $user = $userEntity->setId($id)
            ->setLastName($params['post']['last_name'])
            ->setFirstName($params['post']['first_name'])
            ->setAvatar($params['avatar']['name'])
            ->setDisabled($params['post']['disabled'])
            ->setRole($params['post']['role'])
            ->setPassword($currentUser->getPassword());

        if(!empty($password)) {
            $verifyPassword = password_verify($password, $currentUser->getPassword());

            if($verifyPassword) {
                if($params['post']['new_password'] === $params['post']['confirm_password']) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $user->setPassword($password);
                } else {
                    SessionFlash::sessionFlash("danger", "les mots de passe saisis ne sont pas identiques.");
                    header("Location: /dashboard/utilisateurs/$id");
                    return;
                }
            } else {
                SessionFlash::sessionFlash("danger", "Ancien mot de passe incorrect. Impossible de changer votre mot de passe.");
                header("Location: /dashboard/utilisateurs/$id");
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
                header("Location: /dashboard/utilisateurs/{$user->getId()}");
                return;
            }
        }

        $userRepository->update($user);

        $title = $user->getUsername();

        SessionFlash::sessionFlash("success", "La mise à jour de l'utilisateur ($title) a réussie.");
        header('Location: /dashboard/utilisateurs');
    }

    public function delete(array $params)
    {
        $id = (int)$params['id'];

        $userRepository = new UserRepository();
        $user = $userRepository->find($id);

        if($user->getId() === $id){
            $userRepository->delete($user);
        } else {
            SessionFlash::sessionFlash("danger", "L'utilisateur n'existe pas, suppression impossible.");
            header('Location: /dashboard/utilisateurs');
        }

        SessionFlash::sessionFlash("success", "Suppresion réussie.");

        header('Location: /dashboard/utilisateurs');
    }
}