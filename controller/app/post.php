<?php

namespace app;

class post
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


        //most_comment
        $most_comment_post_ids=\database::select("SELECT post_id FROM `comments` GROUP BY `post_id` ORDER BY COUNT(id) DESC LIMIT 5 ")->fetchAll(\PDO::FETCH_OBJ);
        $most_comment_posts=[];
        foreach ($most_comment_post_ids as $id)
        {
            $id=$id->post_id;
            $most_comment_posts[]=\database::select("SELECT * FROM posts WHERE id=$id")->fetch(\PDO::FETCH_OBJ);
        }
        foreach ($most_comment_posts as $news) {
            $comment_count = \database::select("SELECT COUNT(id) as c_count FROM comments WHERE post_id=$news->id")->fetch(\PDO::FETCH_OBJ)->c_count;
            $news->comment_count = $comment_count;
        }


        //// most_view

        $most_view_post_ids=\database::select("SELECT post_id FROM `views` GROUP BY `post_id` ORDER BY COUNT(id) DESC LIMIT 4 ")->fetchAll(\PDO::FETCH_OBJ);
        $most_view_posts=[];
        foreach ($most_view_post_ids as $id)
        {
            $id=$id->post_id;
            $most_view_posts[]=\database::select("SELECT * FROM posts WHERE id=$id")->fetch(\PDO::FETCH_OBJ);
        }
        foreach ($most_view_posts as $news) {
            $view_count = \database::select("SELECT COUNT(id) as v_count FROM views WHERE post_id=$news->id")->fetch(\PDO::FETCH_OBJ)->v_count;
            $news->view_count = $view_count;
        }
        require_once "view/app/index.php";
    }

    public static function about_us()
    {
        require_once "view/app/about_us.php";
    }


    public static function test($id, $id2)
    {
        for ($i = 1; $i < 5; $i++) {
            $user_ids = [1, 4, 5];
            $user_id = $user_ids[array_rand($user_ids)];
            $user_ip=rand(100,999).".".rand(100,999).".".rand(100,999).".".rand(100,999);

            $post_ids = [2, 3, 10, 17, 16];
            $post_id = $post_ids[array_rand($post_ids)];
            $bodys = "magnis acsenimsAliquam ut felis sociis consequat lorem quis felissultricies necspellentesque vitaeseleifend velsaliquet Lorem dolorsAenean elementum ";
            $bodys = explode(" ", $bodys);
            $body = $bodys[array_rand($bodys)];

            $date = date("Y-m-d H:i:s", rand(1100000000, 1999999999));


            $sql = "INSERT INTO `views`(`user_agent`, `user_ip`, `post_id`, `date`) VALUES
                        ('$body','$user_ip',$post_id,'$date')";
            \database::$conn->exec($sql);
        }

    }
}
