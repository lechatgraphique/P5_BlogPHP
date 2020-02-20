<?php


namespace App\Controller;

use App\Entity\Post;
use App\Libs\Pagination;
use App\Libs\SessionFlash;
use App\Libs\UploadImage;
use App\Render\Twig;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;

class AdminPostController
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

        echo $this->twig->getTwig()->render('backend/dashboard/post/index.twig', [
            "posts" => $posts,
            "flash" => $flash,
            "pagination" => $pagination
        ]);
    }

    public function formCreate()
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

        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/post/formCreate.twig', [
            "categories" => $categories,
            "flash" => $flash
        ]);
    }

    public function formEdit(array $params)
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

        $postRepository = new PostRepository();
        $post = $postRepository->find($params['id']);

        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/post/formEdit.twig', [
            "post" => $post,
            "categories" => $categories,
            "flash" => $flash
        ]);
    }

    public function create(array $params)
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

        $params['post_img'] = $params['post']['image_post'];

        $uploadImage = new UploadImage(
            $params['post_img']['name'],
            $params['post_img']['size'],
            $params['post_img']['tmp_name'],
            $params['post_img']['type']
        );

        if($uploadImage->getErrors()) {
            SessionFlash::sessionFlash("danger", $uploadImage->getErrors());
           header("Location: /dashboard/articles/form-create");
           return;
        }

        $post = new Post();
        $post->setTitle($params['post']['title'])
            ->setSlug($params['post']['slug'])
            ->setUserId(1)
            ->setIsValidated(true)
            ->setDescription($params['post']['description'])
            ->setContent($params['post']['content'])
            ->setCategoryId($params['post']['category_id'])
            ->setImage($params['post_img']['name']);

        $title = $post->getTitle();

        $postRepository = new PostRepository();
        $postRepository->create($post);

        SessionFlash::sessionFlash("success", "L'article ($title) a bien été enregistré.");

        header('Location: /dashboard/articles');
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

        $params['post_img'] = $params['post']['image_post'];

        $postRepository = new PostRepository();

        $postEntity = new Post();
        $post = $postEntity->setId($params['post']['id'])
            ->setTitle($params['post']['title'])
            ->setSlug($params['post']['slug'])
            ->setDescription($params['post']['description'])
            ->setContent($params['post']['content'])
            ->setCategoryId($params['post']['category_id'])
            ->setImage($params['post_img']['name'])
            ->setUpdatedAt(date("Y-m-d H:i:s"));


        $currentPost = $postRepository->find($params['post']['id']);

        if(empty($post->getImage())) {
            $post->setImage($currentPost->getImage());
        }

        if($post->getImage() != $currentPost->getImage()) {
            $uploadImage = new UploadImage(
                $params['post_img']['name'],
                $params['post_img']['size'],
                $params['post_img']['tmp_name'],
                $params['post_img']['type']
            );

            if($uploadImage->getErrors()) {
                SessionFlash::sessionFlash("danger", $uploadImage->getErrors());
                header("Location: /dashboard/articles/form-edit/{$post->getSlug()}-{$post->getId()}");
                return;
            }
        }

        $title = $post->getTitle();

        $postRepository->update($post);

        SessionFlash::sessionFlash("success", "La mise à jour de l'article ($title) a réussie.");
        header('Location: /dashboard/articles');
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

        $postRepository = new PostRepository();
        $post = $postRepository->find($id);

        if($post->getId() === $id){
            $postRepository->delete($post);

            if($post->getImage()){
                unlink('uploads/posts/'.$post->getImage());
            }
        } else {
            SessionFlash::sessionFlash("danger", "L'article n'existe pas, suppression impossible.");
            header('Location: /dashboard/articles');
        }

        SessionFlash::sessionFlash("success", "Suppresion réussie.");

        header('Location: /dashboard/articles');
    }
}
