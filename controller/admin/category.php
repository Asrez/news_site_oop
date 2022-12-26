<?php


class category
{

    public static function index()
    {
        $categories = database::select('select * from categories')->fetchAll(PDO::FETCH_OBJ);
        require_once "view/admin/category/index.php";

    }

    public static function create()
    {
        require_once "view/admin/category/create.php";

    }

    public static function store($request)
    {
        // insert('users', ['username', 'password', 'age'], ['hassank2', '1234', 30]);;
        database::insert("categories", array_keys($request), $request);
        helper::redirect("admin/category");
    }


    public static function edit($id)
    {
        $category = database::select("SELECT * FROM `categories` WHERE `id`=?", [$id])->fetch(PDO::FETCH_OBJ);

        require_once "view/admin/category/edit.php";
    }

    public static function update($request,$id)
    {

// update('users', 2, ['username', 'password'], ['alik2', 12345]);
        database::update("categories",$id,array_keys($request),$request);
        helper::redirect("admin/category");

    }

    public static function delete($id)
    {
        database::delete("categories",$id);
        helper::redirect("admin/category");
    }
}