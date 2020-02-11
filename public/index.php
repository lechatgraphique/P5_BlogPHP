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

$router = new AltoRouter();

$router->map( 'GET', '/', function() use ($twig) {

    echo $twig->render('frontend/home/index.twig', []);
});

$router->map( 'GET', '/posts', function() use ($twig) {
    echo $twig->render('frontend/post/index.twig', []);
});

$router->map( 'GET', '/post', function() use ($twig) {
    echo $twig->render('frontend/post/show.twig', []);
});

$router->map( 'GET', '/contact', function() use ($twig) {
    echo $twig->render('frontend/contact/index.twig', []);
});

$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}