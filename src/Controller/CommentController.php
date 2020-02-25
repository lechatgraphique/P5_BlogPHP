<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class CommentController
{
    public function create(array $params)
    {
        $postRepository = new PostRepository();
        $post = $postRepository->find($params['post']['post_id']);

        $comment = new Comment();
        $comment->setUserId($params['post']['user_id'])
            ->setPostId($params['post']['post_id'])
            ->setIsValidated(0)
            ->setContent($params['post']['content']);

        $commentRepository = new CommentRepository();
        $commentRepository->create($comment);

        header("Location: /articles/{$post->getSlug()}-{$post->getId()}");
    }

    public function delete(array $params)
    {
        $id = (int)$params['id'];

        $currentUser = unserialize($_SESSION['user']);

        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);

        if($currentUser != $comment->getUserId())
        {
            header('Location: /');
            exit();
        }

        $postRepository = new PostRepository();
        $post = $postRepository->find($comment->getPostId());

        $commentRepository->delete($comment);

        header("Location: /articles/{$post->getSlug()}-{$post->getId()}");
    }
}