<?php

namespace auth;
class index
{
    public static function register()
    {

        require_once "view/auth/register.php";
    }
    public static function store($request)
    {
        \helper::flash("a","aaaaaaa");
        var_dump(\helper::flash("a"));
    }
}
