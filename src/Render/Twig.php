<?php


namespace App\Render;


class Twig
{
    protected $twig;
    private $loader;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($this->loader, [
            'debug' => true,
        ]);

        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addExtension(new \App\Libs\twigFiltersExtensions());
    }
    public function render(string $view, array $var = []): string
    {
        extract($var);
        return $this->twig->render($view, $var);
    }
}