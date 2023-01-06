<?php


namespace App\Helper;


class GenerateToken
{

    public static function generateLoginToken($longueur = 64)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/*+&-#{[|\^@]}$!', ceil($longueur / strlen($x)))), 1, $longueur);
    }
}
