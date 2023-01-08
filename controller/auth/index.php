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
        if (!isset($request["username"]) || !isset($request["password"]) || !isset($request["email"]) || !isset($request["captcha"])) {
            \helper::flash("register_error", "همه فیلد ها اجباری هستند");
            \helper::redirect("register");
        } elseif (trim($request["username"] = "") || trim($request["password"] = "") || trim($request["email"] = "") || trim($request["captcha"] = "")) {
            \helper::flash("register_error", "فیلد خالی مجاز نیست");
            \helper::redirect("register");
        } elseif ($_SESSION["captcha"] != $request["captcha"]) {
            \helper::flash("register_error", "کد امنیتی نا درست");
            \helper::redirect("register");
        }
    }
}

