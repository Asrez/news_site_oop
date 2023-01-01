<?php

namespace admin;
class menu
{
    public static function index()
    {
        $menus = \database::select("SELECT m1.*,m2.name  AS parent_name
FROM menus m1
LEFT JOIN menus m2
ON
m1.parent_id=m2.id")->fetchAll(\PDO::FETCH_OBJ);
        require_once "view/admin/menu/index.php";
    }

    public static function edit($id)
    {
        $menu = \database::select("SELECT * FROM `menus` WHERE id=?", [$id])->fetch(\PDO::FETCH_OBJ);
        $all_parent_menus = \database::select("SELECT * FROM `menus` WHERE `parent_id`=0")->fetchAll(\PDO::FETCH_OBJ);

        require_once "view/admin/menu/edit.php";
    }

    public static function create()
    {
        $all_parent_menus = \database::select("SELECT * FROM `menus` WHERE `parent_id`=0")->fetchAll(\PDO::FETCH_OBJ);
        require_once "view/admin/menu/create.php";
    }

    public static function store($request)
    {
        \database::insert("menus", array_keys($request), $request);
        \helper::redirect("admin/menu");
    }

    public static function update($request, $id)
    {
        \database::update("menus", $id, array_keys($request), $request);
        \helper::redirect("admin/menu");
    }

    public static function delete($id)
    {
        \database::delete("menus", $id);
        \helper::redirect("admin/menu");
    }
}
