<?php

class banner
{
    public static function index()
    {
        $banners = database::select("SELECT * FROM `banners`")->fetchAll(PDO::FETCH_OBJ);
        require_once "view/admin/banner/index.php";
    }

    public static function create()
    {
        require_once "view/admin/banner/create.php";
    }

    public static function store($request)
    {
        $request["image"] = helper::saveImage($request["image"], "banner-image");
        if ($request["image"]) {
            database::insert("banners", array_keys($request), $request);
            helper::redirect("admin/banner");
        } else {
            helper::redirect("admin/banner");
        }

    }

    public static function edit($id)
    {
        $banner = database::select("SELECT * FROM `banners` WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        require_once "view/admin/banner/edit.php";
    }

    public static function update($request, $id)
    {
        if ($request["image"]["tmp_name"] !== "") {
            $banner = database::select("SELECT * FROM `banners` WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
            helper::removeImage($banner->image);
            $request["image"] = helper::saveImage($request["image"], "banner-image");
        } else {
            unset($request["image"]);
        }
        database::update("banners", $id, array_keys($request), $request);
        helper::redirect("admin/banner");
    }

    public static function delete($id)
    {
        $banner = database::select("SELECT * FROM `banners` WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        helper::removeImage($banner->image);
        database::delete("banners", $id);
        helper::redirect("admin/banner");

    }
}