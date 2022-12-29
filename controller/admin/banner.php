<?php

class banner
{
    public static function index()
    {
        require_once "view/admin/banner/index.php";
    }

    public static function create()
    {
        require_once "view/admin/banner/create.php";
    }

    public static function edit()
    {
        require_once "view/admin/banner/edit.php";
    }
}