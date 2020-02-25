<?php


namespace App\Libs;


use App\Entity\User;

class Auth
{
    public static function user(): ?User
    {
        $user = array_key_exists('user', $_SESSION) ? unserialize($_SESSION['user']) : null;
        return $user;
    }

    public static function login(User $user): void
    {
        $_SESSION['user'] = serialize($user);
    }

    public static function logoff(): void
    {
        unset($_SESSION['user']);
    }
}