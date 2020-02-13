<?php

require "../vendor/autoload.php";

$whoops = new \Whoops\Run;

$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$router = new AltoRouter();

$router->map('GET', '/', 'App\Controller\PostController#home');
$router->map('GET', '/articles', 'App\Controller\PostController#index');
$router->map('GET', '/articles/[*:slug]-[i:id]', 'App\Controller\PostController#show');
$router->map('GET', '/contact', 'App\Controller\ContactController#index');
$router->map('GET', '/inscription', 'App\Controller\InscriptionController#index');
$router->map('GET', '/connexion', 'App\Controller\ConnexionController#index');

$match = $router->match();

if ($match) {
    $path = explode('#', $match['target']);
    $controller = $path[0];
    $method = $path[1];
    $params = $match['params'];
    $object = new $controller();
    $object->{$method}($params);

} else {
    header("Status: 404 Not Found", false, 404);
    header("Location: /articles");
}
