<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Libs\Pagination;
use App\Libs\SessionFlash;
use App\Render\Twig;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class AdminCommentController
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index(array $params)
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            header("Location: /");
            return;

        } else {
            header("Location: /");
            return;
        }

        if($user->getRole() != "ADMINISTRATOR") {
            header("Location: /");
            return;

        }

        $page = $params['get']['page'];

        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();


        $countPosts = count($postRepository->findAll());
        $pagination = null;

        if($page === null){
            $page = 1;
        }

        if($countPosts > 5) {
            $PaginationFinal = new Pagination();
            $PaginationFinal->setCurrentPage($page);
            $PaginationFinal->setInnerLinks(2);
            $PaginationFinal->setNbElementsInPage(5);
            $PaginationFinal->setNbMaxElements($countPosts);
            $PaginationFinal->setUrl("/dashboard/articles?page={i}");

            $pagination = $PaginationFinal->renderBootstrapPagination();
            $posts = $PaginationFinal->setContent($posts);


        }

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/comment/index.twig', [
            "posts" => $posts,

            "flash" => $flash,
            "pagination" => $pagination
        ]);
    }

    public function update(array $params)
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            header("Location: /");
            return;

        } else {
            header("Location: /");
            return;
        }

        if($user->getRole() != "ADMINISTRATOR") {
            header("Location: /");
            return;

        }

        $id = (int)$params['id'];

        $commentRepository = new CommentRepository();
        $commentEntity = new Comment();

        $comment = $commentEntity->setId($id)->setIsValidated(1);

        $commentRepository->validatedComment($comment);

        SessionFlash::sessionFlash("success", "Validation réussie.");

        header('Location: /dashboard/commentaires');
    }

    public function delete(array $params)
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;

        if(!isset($user)) {
            header("Location: /");
            return;

        } else {
            header("Location: /");
            return;
        }

        if($user->getRole() != "ADMINISTRATOR") {
            header("Location: /");
            return;

        }

        $id = (int)$params['id'];

        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);

        $commentRepository->delete($comment);

        SessionFlash::sessionFlash("success", "Suppresion réussie.");

        header('Location: /dashboard/commentaires');
    }
}