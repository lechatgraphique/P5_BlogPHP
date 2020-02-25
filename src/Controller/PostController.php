<?php


namespace App\Controller;


use App\Libs\Pagination;
use App\Render\Twig;
use App\Repository\PostRepository;


class PostController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function home()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        echo $this->twig->getTwig()->render('frontend/home/index.twig', [
            'posts' => $posts
        ]);
    }

    public function index(array $params)
    {
        $page = $params['get']['page'];

        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        $countPosts = count($postRepository->findAll());

        $pagination = null;

        if($page === null){
            $page = 1;
        }

        if($countPosts > 6) {
            $PaginationFinal = new Pagination();
            $PaginationFinal->setCurrentPage($page);
            $PaginationFinal->setInnerLinks(2);
            $PaginationFinal->setNbElementsInPage(6);
            $PaginationFinal->setNbMaxElements($countPosts);
            $PaginationFinal->setUrl("/articles?page={i}");

            $pagination = $PaginationFinal->renderBootstrapPagination();
            $posts = $PaginationFinal->setContent($posts);
        }


        echo $this->twig->getTwig()->render('frontend/post/index.twig', [
            'posts' => $posts,
            "pagination" => $pagination
        ]);
    }

    public function show($params)
    {
        $postRepository = new PostRepository();
        $post = $postRepository->find($params['id']);
        $comments = $post->getComments();

        echo $this->twig->getTwig()->render('frontend/post/show.twig', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}