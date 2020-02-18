<?php


namespace App\Controller;


use App\Libs\SessionFlash;
use App\Render\Twig;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;

class AdminCategoryController
{
    private $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index(array $params)
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        echo $this->twig->getTwig()->render('backend/dashboard/category/index.twig', [
            "categories" => $categories
        ]);
    }

    public function delete(array $params)
    {
        $id = (int)$params['id'];

        $categoryRepository = new CategoryRepository();
        $categorie = $categoryRepository->find($id);

        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();

        foreach ($posts as $post) {
            if($post->getCategoryId() === $categorie->getId()) {
                $post->setCategoryId(0);
                $postRepository->update($post);
            }
        }

        if($categorie->getId() === $id){

            $categoryRepository->delete($categorie);

        } else {
            SessionFlash::sessionFlash("danger", "La catégorie n'existe pas, suppression impossible.");
            header('Location: /dashboard/categories');
        }

        SessionFlash::sessionFlash("success", "Suppresion réussie.");

        header('Location: /dashboard/categories');
    }
}