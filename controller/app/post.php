<?php

namespace app;

require_once "main.php";

use app\main;

class post extends main
{
    public static function index($id)
    {
        $all_menus = parent::menus();
        $most_comment_posts = parent::most_comment();
        $selected_news = parent::selected_news();
        $banners = parent::banners();
        $post = self::get_post($id);
        $most_view_posts = parent::most_view();
        if ($post === false) {
            \helper::redirect("");
        }
        $comments = self::get_comment($id);
        require_once "view/app/image-post.php";

    }

    public static function get_post($id)
    {
        $post = \database::select("SELECT * FROM `posts` WHERE id=?", [$id])->fetch(\PDO::FETCH_OBJ);
        return $post;

    }

    public static function get_comment($id)
    {
        $comments = \database::select("SELECT * FROM `comments` WHERE post_id=?", [$id])->fetchAll(\PDO::FETCH_OBJ);
        return $comments;
    }

    public static function add_comment($request, $id)
    {
        if (!isset($request["name"]) || !isset($request["email"]) || !isset($request["body"]) || !isset($request["captcha"])) {
            \helper::flash("comment_error", "فیلد خالی مجاز نیست!!");
            \helper::redirect("news/$id");
        } else if (!filter_var($request["email"], FILTER_VALIDATE_EMAIL)) {
            \helper::flash("comment_error", "ایمیل نا معتبر!!");
            \helper::redirect("news/$id");
        } else if ($request["captcha"] != $_SESSION["captcha"]) {
            \helper::flash("comment_error", "کد امنیتی نا معتبر!!");;
            \helper::redirect("news/$id");
        } else {
            $request["ip"] = \helper::get_real_ip();
            $request["agent"] = $_SERVER["HTTP_USER_AGENT"];
            $comment_count = \database::select("SELECT count(id) FROM `comments` WHERE (ip=? OR email=?) AND post_id=? AND `status`!=?", [$request["ip"], $request["email"], $id, "approved"])->fetchColumn();
            if ($comment_count > 3) {
                \helper::flash("comment_error", "تعداد کامنت های تایید نشده برای هر پست نمیتواند بیشتر از 3 باشد");
                \helper::redirect("news/$id");
            } else {
                unset($request["captcha"]);
                $request["post_id"] = $id;
                \database::insert("comments", array_keys($request), $request);

            }
        }
    }


}
