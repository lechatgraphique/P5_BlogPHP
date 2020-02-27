<?php
session_start();
require "../vendor/autoload.php";

$whoops = new \Whoops\Run;

$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new AltoRouter();

$router->map('GET', '/', 'App\Controller\PostController#home');
$router->map('GET', '/articles', 'App\Controller\PostController#index');
$router->map('GET', '/articles/[*:slug]-[i:id]', 'App\Controller\PostController#show');
$router->map('POST', '/commentaire/create/', 'App\Controller\CommentController#create');
$router->map('GET', '/commentaire/[i:id]/delete', 'App\Controller\CommentController#delete');
$router->map('GET', '/contact', 'App\Controller\ContactController#index');
$router->map('POST', '/contact/send', 'App\Controller\ContactController#send');

$router->map('GET', '/inscription', 'App\Controller\InscriptionController#index');
$router->map('POST', '/inscription/create/', 'App\Controller\InscriptionController#create');

$router->map('GET', '/connexion', 'App\Controller\ConnexionController#index');
$router->map('POST', '/connexion/login/', 'App\Controller\ConnexionController#login');

$router->map('GET', '/deconnexion', 'App\Controller\ConnexionController#disconnect');

$router->map('GET', '/dashboard', 'App\Controller\AdminController#index');

$router->map('GET', '/dashboard/articles', 'App\Controller\AdminPostController#index');
$router->map('GET', '/dashboard/articles/[*:slug]-[i:id]', 'App\Controller\AdminPostController#formEdit');
$router->map('POST','/dashboard/articles/update/', 'App\Controller\AdminPostController#update');
$router->map('GET','/dashboard/articles/[*:slug]-[i:id]/delete', 'App\Controller\AdminPostController#delete');
$router->map('GET','/dashboard/articles/form-create', 'App\Controller\AdminPostController#formCreate');
$router->map('POST','/dashboard/articles/create/', 'App\Controller\AdminPostController#create');

$router->map('GET', '/dashboard/categories', 'App\Controller\AdminCategoryController#index');
$router->map('GET', '/dashboard/categories/[*:slug]-[i:id]', 'App\Controller\AdminCategoryController#formEdit');
$router->map('POST','/dashboard/categories/update/', 'App\Controller\AdminCategoryController#update');
$router->map('GET','/dashboard/categories/[*:slug]-[i:id]/delete', 'App\Controller\AdminCategoryController#delete');
$router->map('GET','/dashboard/categories/form-create', 'App\Controller\AdminCategoryController#formCreate');
$router->map('POST','/dashboard/categories/create/', 'App\Controller\AdminCategoryController#create');

$router->map('GET', '/dashboard/utilisateurs', 'App\Controller\AdminUserController#index');
$router->map('GET', '/dashboard/utilisateurs/[i:id]', 'App\Controller\AdminUserController#formEdit');
$router->map('POST','/dashboard/utilisateurs/update/', 'App\Controller\AdminUserController#update');
$router->map('GET','/dashboard/utilisateurs/[i:id]/delete', 'App\Controller\AdminUserController#delete');
$router->map('GET','/dashboard/utilisateurs/form-create', 'App\Controller\AdminUserController#formCreate');
$router->map('POST','/dashboard/utilisateurs/create/', 'App\Controller\AdminUserController#create');

$router->map('GET','/dashboard/commentaires', 'App\Controller\AdminCommentController#index');
$router->map('GET','/dashboard/commentaires/[i:id]/delete', 'App\Controller\AdminCommentController#delete');
$router->map('GET','/dashboard/commentaires/[i:id]/update', 'App\Controller\AdminCommentController#update');

$router->map('GET','/profil/[i:id]', 'App\Controller\ProfilController#index');
$router->map('POST','/profil/update/', 'App\Controller\ProfilController#update');


$match = $router->match();

if ($match) {
    $path = explode('#', $match['target']);
    $controller = $path[0];
    $method = $path[1];
    if($_GET) {
        $arrayParams = $_GET;
        $match['params']['get'] = $arrayParams;
    }
    if($_POST) {

        $arrayParams = array_merge($_POST, $_FILES);
        $match['params']['post'] = $arrayParams;
    }
    $params = $match['params'];

    $object = new $controller();
    $object->{$method}($params);

} else {
    header("Status: 404 Not Found", false, 404);
    header("Location: /articles");
}


