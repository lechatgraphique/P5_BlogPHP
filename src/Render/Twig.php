<?php


namespace App\Render;


class Twig
{
    public static function run()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $twig->addExtension(new \App\Libs\twigFiltersExtensions());

        return $twig;
    }
}