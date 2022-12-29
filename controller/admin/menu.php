<?php

class menu
{
    public static function index()
    {
     require_once "view/admin/menu/index.php";
    }

    public static function edit()
    {
        require_once "view/admin/menu/edit.php";
    }

    public static function creat()
    {
        require_once "view/admin/menu/create.php";
    }
}
