<?php

require "../vendor/autoload.php";

$whoops = new \Whoops\Run;

$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addExtension(new \App\Libs\twigFiltersExtensions());

$router = new AltoRouter();

$router->map( 'GET', '/', function() use ($twig) {

$postController = new \App\Controller\PostController();
$posts = $postController->listPosts();

echo $twig->render('frontend/home/index.twig', ['posts' => $posts]);

});

$router->map( 'GET', '/articles', function() use ($twig) {

    $postController = new \App\Controller\PostController();
    $posts = $postController->listPosts();

    echo $twig->render('frontend/post/index.twig', ["posts" => $posts]);

});

$router->map( 'GET', '/articles/[*:slug]-[i:id]', function($slug, $id) use ($twig) {

    $postController = new \App\Controller\PostController();
    $post = $postController->post($id);

    echo $twig->render('frontend/post/show.twig', ['post' => $post]);

});

$router->map( 'GET', '/contact', function() use ($twig) {
    echo $twig->render('frontend/contact/index.twig', []);
});

$match = $router->match();

if($match !== false){
    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] );
    } else {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
} else {
    header("Status: 404 Not Found", false, 404);
    header("Location: /articles");
}
