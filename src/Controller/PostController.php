<?php


namespace App\Controller;

use App\Render\Twig;
use App\Repository\PostRepository;

class PostController
{
    public function home()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        $twig = Twig::run();
        echo $twig->render('frontend/home/index.twig', [
            'posts' => $posts
        ]);
    }

    public function index()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        $twig = Twig::run();
        echo $twig->render('frontend/post/index.twig', [
            'posts' => $posts
        ]);
    }

    public function show($params)
    {
        $postRepository = new PostRepository();
        $post = $postRepository->find($params['id']);
        $comments = $post->getComments();

        $twig = Twig::run();
        echo $twig->render('frontend/post/show.twig', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}