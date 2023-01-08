<?php

class comment
{
    public static function index()
    {
        $comments = database::select(
            "SELECT * FROM comments")->fetchAll(PDO::FETCH_OBJ);
        require_once "view/admin/comment/index.php";
    }

    public static function status_edit_to_approved($id)
    {
        $sql = "UPDATE `comments` SET `status`= :status WHERE `id`=:id";
        $stmt = database::$conn->prepare($sql);
        $stmt->bindValue("status", "approved");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        helper::redirect("admin/comment");
    }

    public static function status_edit_to_seen($id)
    {
        $sql = "UPDATE `comments` SET `status`= :status WHERE `id`=:id";
        $stmt = database::$conn->prepare($sql);
        $stmt->bindValue("status", "seen");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        helper::redirect("admin/comment");
    }

}