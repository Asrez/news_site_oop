<?php


class user
{

    public static function index()
    {
        $users = database::select('select * from users')->fetchAll(PDO::FETCH_OBJ);
        require_once "view/admin/user/index.php";

    }

    public static function edit($id)
    {
        $user = database::select("SELECT * FROM `users` WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        require_once "view/admin/user/edit.php";
    }

    public static function update($request, $id)
    {
        database::update("users",$id,array_keys($request),$request);
        helper::redirect("admin/user");
    }

    public static function delete($id)
    {
        database::delete("users", $id);
        helper::redirect("admin/user");
    }

    public static function permission_edit($id)
    {
        $user = database::select("SELECT * FROM `users` WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        if ($user->permission == "admin") {
            database::update("users", $id, ["permission"], ["user"]);
        } elseif ($user->permission == "user") {
            database::update("users", $id, ["permission"], ["admin"]);
        }
        helper::redirect("admin/user");

    }
}