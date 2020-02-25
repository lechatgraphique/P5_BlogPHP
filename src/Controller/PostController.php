<?php


namespace App\Controller;


use App\Libs\Pagination;
use App\Render\Twig;
use App\Repository\CommentRepository;
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
        $url = 'accueil';
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        echo $this->twig->getTwig()->render('frontend/home/index.twig', [
            'posts' => $posts,
            'url' => $url
        ]);
    }

    public function index(array $params)
    {
        $url = 'articles';
        $page = $params['get']['page'];

        $postRepository = new PostRepository();
        $posts = $postRepository->findValidated();

        $countPosts = count($posts);

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
            'url' => $url,
            "pagination" => $pagination
        ]);
    }

    public function show($params)
    {
        $url = 'articles';
        $page = $params['get']['page'];

        $postRepository = new PostRepository();
        $post = $postRepository->find($params['id']);

        $commentRepository = new CommentRepository();
        $comments = $commentRepository->findValidated($params['id']);

        $countComments = count($comments);

        $pagination = null;

        if($page === null){
            $page = 1;
        }

        if($countComments > 5) {
            $PaginationFinal = new Pagination();
            $PaginationFinal->setCurrentPage($page);
            $PaginationFinal->setInnerLinks(2);
            $PaginationFinal->setNbElementsInPage(5);
            $PaginationFinal->setNbMaxElements($countComments);
            $PaginationFinal->setUrl("/articles/{$post->getSlug()}-{$post->getId()}?page={i}");

            $pagination = $PaginationFinal->renderBootstrapPagination();
            $comments = $PaginationFinal->setContent($comments);
        }

        echo $this->twig->getTwig()->render('frontend/post/show.twig', [
            'post' => $post,
            'url' => $url,
            'comments' => $comments,
            "pagination" => $pagination
        ]);
    }
}