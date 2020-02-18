<?php


namespace App\Controller;


use App\Entity\Category;
use App\Libs\Pagination;
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
        $page = $params['get']['page'];

        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        $countCategories = count($categoryRepository->findAll());
        $pagination = null;

        if($page === null){
            $page = 1;
        }

        if($countCategories > 5) {
            $PaginationFinal = new Pagination();
            $PaginationFinal->setCurrentPage($page);
            $PaginationFinal->setInnerLinks(2);
            $PaginationFinal->setNbElementsInPage(5);
            $PaginationFinal->setNbMaxElements($countCategories);
            $PaginationFinal->setUrl("/dashboard/categories?page={i}");

            $pagination = $PaginationFinal->renderBootstrapPagination();
            $categories = $PaginationFinal->setContent($categories);
        }

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/category/index.twig', [
            "categories" => $categories,
            "flash" => $flash,
            "pagination" => $pagination
        ]);
    }

    public function formCreate()
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/category/formCreate.twig', [
            "categories" => $categories,
            "flash" => $flash
        ]);
    }

    public function formEdit(array $params)
    {
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->find($params['id']);

        $flash = SessionFlash::renderSessionFlash();

        echo $this->twig->getTwig()->render('backend/dashboard/category/formEdit.twig', [
            "category" => $category,
            "flash" => $flash
        ]);
    }

    public function create(array $params)
    {
        $category = new Category();
        $category->setTitle($params['post']['title'])
            ->setSlug($params['post']['slug']);

        $title = $category->getTitle();

        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();

        foreach ($categories as $currentCategory) {
            if($category->getTitle() === $currentCategory->getTitle()) {
                SessionFlash::sessionFlash("danger", "La catégorie {$category->getTitle()} existe déjà.");
                header("Location: /dashboard/categories/form-create");
                return;
            }
        }

        $categoryRepository->create($category);

        SessionFlash::sessionFlash("success", "La catégorie ($title) a bien été enregistré.");

        header('Location: /dashboard/categories');
    }

    public function update(array $params)
    {
        $categoryRepository = new CategoryRepository();

        $categoryEntity = new Category();
        $category = $categoryEntity->setId($params['post']['id'])
            ->setTitle($params['post']['title'])
            ->setSlug($params['post']['slug']);

        $title = $category->getTitle();

        $categoryRepository->update($category);

        SessionFlash::sessionFlash("success", "La mise à jour de la catégorie ($title) a réussie.");
        header('Location: /dashboard/categories');
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