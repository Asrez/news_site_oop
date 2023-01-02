<?php


class post
{

    public static function index()
    {
        $posts = database::select("
                                        SELECT
                                               posts.*,
                                               users.id as user_id ,
                                               users.username as writer
                                        FROM
                                             `posts` 
                                        INNER JOIN
                                               `users`
                                        ON 
                                            posts.user_id=users.id
                                               ")->fetchAll(PDO::FETCH_OBJ);
        // get name the categories whit id
        foreach ($posts as $key => $post) {
            $post_category = database::select("
                                        SELECT 
                                            categories.id ,`name` 
                                        FROM 
                                             post_category
                                        INNER JOIN
                                             categories
                                        ON 
                                            post_category.category_id=categories.id
                                        WHERE `post_id`=?
                                        ", [$post->id])->fetchAll(PDO::FETCH_OBJ);
            $posts[$key]->categories = $post_category;
        }
        require_once "view/admin/post/index.php";

    }

    public static function create()
    {
        $all_categories = database::select("SELECT id,name FROM categories")->fetchAll(PDO::FETCH_OBJ);
        require_once "view/admin/post/create.php";
    }

    public static function store($request)
    {
        //convert from mili s to s and add as datetime
        $request["published_at"] = date("Y-m-d H:i:s", $request["published_at"] / 1000);

        if (isset($request["categories"])) {
            $categories = $request["categories"];
            unset($request["categories"]);
        } else {
            helper::redirect('admin/post');
        }
        $request['image'] = helper::saveImage($request['image'], 'post-image');
        if ($request['image']) {
            $request = array_merge($request, ['user_id' => 1]);
            database::insert('posts', array_keys($request), $request);
        } else {
            helper::redirect('admin/post');
        }
        $post_id = database::select("SELECT MAX(Id) FROM posts")->fetch()[0];

        foreach ($categories as $category) {
            $sql = "INSERT INTO `post_category`(`post_id`, `category_id`) VALUES ($post_id,$category)";
            database::$conn->exec($sql);
        }
        helper::redirect('admin/post');

    }

    public static function edit($id)
    {
        $post = database::select("SELECT * FROM posts WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        $post_categories = database::select("
                                        SELECT
                                               categories.id as cat_id ,
                                               categories.name as cat_name
                                        FROM
                                             categories
                                        INNER JOIN 
                                              post_category   
                                        ON 
                                            categories.id=post_category.category_id
                                        WHERE 
                                            post_category.post_id=$id
                                             ")->fetchAll(PDO::FETCH_OBJ);
        $all_categories = database::select("SELECT id,name FROM categories")->fetchAll(PDO::FETCH_OBJ);
        $post->categories = $post_categories;
        require_once "view/admin/post/edit.php";
    }

    public static function update($request, $id)
    {
        //convert from mili s to s and add as datetime
        $request["published_at"] = date("Y-m-d H:i:s", $request["published_at"] / 1000);
        
        if (isset($request["category"])) {
            $categories = $request["category"];
            unset($request["category"]);
        } else {
            $_SESSION["error"] = ["empty_category" => "حداقل یک دسته بندی انتخاب کنید"];
            helper::redirect("admin/post/edit/$id");
        }

        if ($request["image"]["tmp_name"] == "") {
            unset($request["image"]);
        } else {
            $request['image'] = helper::saveImage($request['image'], 'post-image');
        }
        database::update("posts", $id, array_keys($request), $request);
        $sql = "DELETE FROM `post_category` WHERE `post_id`=:post_id";
        $stmt = database::$conn->prepare($sql);
        $stmt->bindValue("post_id", $id);
        $stmt->execute();

        foreach ($categories as $category) {
            $sql = "INSERT INTO `post_category`( `post_id`, `category_id`) VALUES (:post_id,:category)";
            $stmt = database::$conn->prepare($sql);
            $stmt->bindValue("post_id", $id);
            $stmt->bindValue("category", $category);
            $stmt->execute();
        }
        helper::redirect("admin/post");
    }


    public static function delete($id)
    {
        database::delete("posts", $id);
        helper::redirect("admin/post");

    }

    public static function show($id)
    {
        require_once "view/admin/post/show.php";
    }

    public static function edit_braking($id)
    {
        $is_brake_status = database::select("SELECT is_brake FROM posts WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        if ($is_brake_status->is_brake == 0) {
            database::update("posts", $id, ["is_brake"], [1]);
        } elseif ($is_brake_status->is_brake == 1) {
            database::update("posts", $id, ["is_brake"], [0]);
        }
        helper::redirectBack();
    }

    public static function edit_selected($id)
    {
        $is_selected_status = database::select("SELECT is_selected FROM posts WHERE id=?", [$id])->fetch(PDO::FETCH_OBJ);
        if ($is_selected_status->is_selected == 0) {
            database::update("posts", $id, ["is_selected"], [1]);
        } elseif ($is_selected_status->is_selected == 1) {
            database::update("posts", $id, ["is_selected"], [0]);
        }
        helper::redirectBack();
    }

    public static function test()
    {
        /*
          foreach ($categories as $category) {
                foreach ($old_cats as $cat) {
                    if ($cat->category_id != $category) {
                        $sql = "INSERT INTO `post_category`(`post_id`, `category_id`) VALUES (:id,:category)";
                        $stmt = database::$conn->prepare($sql);
                        $stmt->bindValue("id", $id);
                        $stmt->bindValue("category", $category);
                        $stmt->execute();
                        break;
                    }
                }
            }

            foreach ($old_cats as $cat) {
                foreach ($categories as $category) {
                    if ($cat->category_id != $category) {
                        database::delete("post_category", $cat->id);
                    }
                }
            }*/
    }
}