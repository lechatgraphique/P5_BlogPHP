<?php


namespace App\Controller;


use App\Render\Twig;
use App\Repository\PostRepository;
use Twig\Environment;

class PostController extends Twig
{
    public function home()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        echo $this->twig->render('frontend/home/index.twig', [
            'posts' => $posts
        ]);
    }

    public function index()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        ;
        echo $this->twig->render('frontend/post/index.twig', [
            'posts' => $posts
        ]);
    }

    public function show($params)
    {
        $postRepository = new PostRepository();
        $post = $postRepository->find($params['id']);
        $comments = $post->getComments();

        echo $this->twig->render('frontend/post/show.twig', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}