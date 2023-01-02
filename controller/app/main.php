<?php


class main
{
    public static function index()
    {

        //selected news
        $selected_news = \database::select("
                        SELECT posts.*,users.username AS writer
                        FROM `posts`
                        INNER JOIN users
                        ON posts.user_id=users.id
                        WHERE `published_at` <= now() AND `is_selected`=1 
                        LIMIT 5 
                         ")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($selected_news as $news) {
            $comment_count = \database::select("SELECT COUNT(id) as c_count FROM comments WHERE post_id=$news->id")->fetch(\PDO::FETCH_OBJ)->c_count;
            $news->comment_count = $comment_count;
        }

        //most_comment

        $most_comment_post_ids = \database::select("SELECT post_id FROM `comments` GROUP BY `post_id` ORDER BY COUNT(id) DESC LIMIT 5 ")->fetchAll(\PDO::FETCH_OBJ);
        $most_comment_posts = [];
        foreach ($most_comment_post_ids as $id) {
            $id = $id->post_id;
            $most_comment_posts[] = \database::select("SELECT * FROM posts WHERE id=$id")->fetch(\PDO::FETCH_OBJ);
        }
        foreach ($most_comment_posts as $news) {
            $comment_count = \database::select("SELECT COUNT(id) as c_count FROM comments WHERE post_id=$news->id")->fetch(\PDO::FETCH_OBJ)->c_count;
            $news->comment_count = $comment_count;
        }

        ///top_nav
        $all_menus = \database::select("SELECT * FROM `menus`")->fetchAll(\PDO::FETCH_OBJ);

        //ads_banner
        $banners_top = \database::select("SELECT * FROM `banners` WHERE `position`='top'")->fetch(\PDO::FETCH_OBJ);
        $banners_side = \database::select("SELECT * FROM `banners` WHERE `position`='side'")->fetch(\PDO::FETCH_OBJ);
        $banners_down = \database::select("SELECT * FROM `banners`WHERE `position`='down'")->fetch(\PDO::FETCH_OBJ);

    }
}
