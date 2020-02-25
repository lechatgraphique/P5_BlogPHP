<?php


namespace App\Controller;


use App\Libs\SendEmail;
use App\Render\Twig;

class ContactController
{
    public $twig;

    public function __construct()
    {
        $this->twig = new Twig();
    }

    public function index()
    {
        $url = 'contact';
        echo $this->twig->getTwig()->render('frontend/contact/index.twig', [
            'url' => $url
        ]);
    }

    static function send(array $params)
    {
        $sendEmailManager = new SendEmail();
        $sendEmailManager->sendEmail($params['post']['to'], $params['post']['name'], $params['post']['subject'], $params['post']['message']);

        header("Location: /contact");
    }
}