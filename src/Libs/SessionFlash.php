<?php


namespace App\Libs;


class SessionFlash
{
    public static function renderSessionFlash()
    {
        $flash = null;
        if(isset($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        return $flash;
    }

    /**
     * @param string $type
     * @param string $content
     */
    public static function sessionFlash(string $type, string $content)
    {
        $type = strtolower($type);
        $_SESSION['flash'] = [
            "type" => $type,
            "content" => $content
        ];
    }

}