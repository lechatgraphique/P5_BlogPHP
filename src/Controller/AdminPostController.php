<?php


namespace App\Controller;

use App\Entity\Post;
use App\Libs\SessionFlash;
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

    public function index()
    {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/post/index.twig', [
            "posts" => $posts,
            "flash" => $flash
        ]);
    }

    public function formCreate()
    {
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
        $postRepository = new PostRepository();
        $post = $postRepository->find($params['id']);
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        echo $this->twig->getTwig()->render('backend/dashboard/post/formEdit.twig', [
            "post" => $post,
            "categories" => $categories
        ]);
    }

    public function create(array $params)
    {
        $id = (int)$params['id'];

        $post = new Post();
        $post->setTitle($params['post']['title'])
            ->setSlug($params['post']['slug'])
            ->setUserId(1)
            ->setIsValidated(true)
            ->setDescription($params['post']['description'])
            ->setContent($params['post']['content'])
            ->setCategoryId($params['post']['category_id']);

        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        foreach ($posts as $currentPost){
            if($currentPost->getSlug() === $post->getSlug()){
                SessionFlash::sessionFlash("danger", "Le slug existe déjà.");
                header('Location: /dashboard/articles/form-create');
            }
        }
        $postRepository->create($post);

        header('Location: /dashboard/articles');
    }

    public function update(array $params)
    {
        $postEntity = new Post();
        $post = $postEntity->setId($params['post']['id'])
            ->setTitle($params['post']['title'])
            ->setSlug($params['post']['slug'])
            ->setDescription($params['post']['description'])
            ->setContent($params['post']['content'])
            ->setCategoryId($params['post']['category_id'])
            ->setUpdatedAt(date("Y-m-d H:i:s"));

            // Add userId, setImage (plus tard)

        $title = $post->getTitle();

        $postRepository = $postRepository = new PostRepository();
        $postRepository->update($post);

        SessionFlash::sessionFlash("success", "La mise à jour de l'article ($title) a réussie.");
        header('Location: /dashboard/articles');
    }

    public function delete(array $params)
    {
        $id = (int)$params['id'];

        $postRepository = new PostRepository();
        $post = $postRepository->find($id);

        if($post->getId() === $id){
            $postRepository->delete($post);
        } else {
            SessionFlash::sessionFlash("danger", "L'article n'existe pas, suppression impossible.");
            header('Location: /dashboard/articles');
        }

        SessionFlash::sessionFlash("success", "Suppresion réussie.");

        header('Location: /dashboard/articles');
    }
}
