<?php


namespace app\core;


class Cookie
{

    public static function get($key)
    {


        return $_COOKIE[$key] ?? false;
    }
}
