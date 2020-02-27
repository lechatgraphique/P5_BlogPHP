<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Libs\Auth;
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

    public function index()
    {
        if(Auth::user()->getRole() != 'ADMINISTRATOR') {
            header("Location: /");
            return;
        }

        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/comment/index.twig', [
            "posts" => $posts,
            "flash" => $flash

        ]);
    }

    public function update(array $params)
    {
        if(Auth::user()->getRole() != 'ADMINISTRATOR') {
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
        if(Auth::user()->getRole() != 'ADMINISTRATOR') {
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