<?php
require_once "public/PHPMailer-6.7.1/src/SMTP.php";
require_once "public/PHPMailer-6.7.1/src/Exception.php";
require_once "public/PHPMailer-6.7.1/src/PHPMailer.php";
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

    private function sendMail($emailAddress, $subject, $body)
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->CharSet = "UTF-8"; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = "smtp.gmail.com"; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = "homayounimoghaddam@gmail.com"; //SMTP username
            $mail->Password = EMAIL_PASS; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
            $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom("onlinephp.attendance@gmail.com", "mr.homayouni");
            $mail->addAddress($emailAddress);


            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }

    public static function send()
    {
        $send=new user();
        $send->sendMail("mrhomayounii1@gmail.com","salam","<p> saaaaaaalaaaaam </p>>");

    }


}
