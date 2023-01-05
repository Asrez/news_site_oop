<?php

namespace app;

require_once "main.php";

use app\main;

class index extends main
{
    public static function index()
    {
        $all_menus = parent::menus();
        $most_comment_posts = parent::most_comment();
        $selected_news = parent::selected_news();
        $banners = parent::banners();
        $most_view_posts = parent::most_view();
        $last_news=self::last_news();

        require_once "view/app/index.php";
    }

    public static function last_news()
    {
        //last news
        $last_news = \database::select("
                        SELECT posts.*,users.username AS writer 
                        FROM `posts`
                        INNER JOIN users
                        ON posts.user_id=users.id
                        WHERE `published_at` <= now()
                        ORDER BY COALESCE(posts.updated_at,posts.created_at) DESC,posts.id DESC
                         LIMIT 10 
                         ")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($last_news as $news) {
            $comment_count = \database::select("SELECT COUNT(id) as c_count FROM comments WHERE post_id=$news->id")->fetch(\PDO::FETCH_OBJ)->c_count;
            $news->comment_count = $comment_count;
        }

        return $last_news;
    }

    public static function about_us()
    {
        require_once "view/app/about_us.php";
    }


}
