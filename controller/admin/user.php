<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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
        database::update("users", $id, array_keys($request), $request);
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

    public static function send_email()
    {


        require_once "vendor/autoload.php";

//PHPMailer Object
        $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

//From email address and name
        $mail->From = "from@yourdomain.com";
        $mail->FromName = "Full Name";

//To address and name
        $mail->addAddress("recepient1@example.com", "Recepient Name");
        $mail->addAddress("recepient1@example.com"); //Recipient name is optional

//Address to which recipient will reply
        $mail->addReplyTo("reply@yourdomain.com", "Reply");

//CC and BCC
        $mail->addCC("cc@example.com");
        $mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = "Subject Text";
        $mail->Body = "<i>Mail body in HTML</i>";
        $mail->AltBody = "This is the plain text version of the email content";

        try {
            $mail->send();
            echo "Message has been sent successfully";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}