<?php

require_once "autoloder.php";
require_once "core/config.php";
require_once "controller/admin/category.php";
require_once "controller/admin/menu.php";
require_once "controller/admin/dashboard.php";
require_once "controller/app/category.php";
require_once "controller/app/index.php";
require_once "controller/app/post.php";
require_once "controller/auth/index.php";


date_default_timezone_set("Asia/Tehran");


$db = new database();

session_start();

//config
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', helper::currentDomain() . '/news_site_oop');

function uri($reservedUrl, $class, $method, $requestMethod = 'GET')
{

    //current url array
    $currentUrl = explode('?', helper::currentUrl())[0];
    $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
    $currentUrl = trim($currentUrl, '/');
    $currentUrlArray = explode('/', $currentUrl);
    $currentUrlArray = array_filter($currentUrlArray);

    //reserved Url array
    $reservedUrl = trim($reservedUrl, '/');
    $reservedUrlArray = explode('/', $reservedUrl);
    $reservedUrlArray = array_filter($reservedUrlArray);

    if (sizeof($currentUrlArray) != sizeof($reservedUrlArray) || helper::methodField() != $requestMethod) {
        return false;
    }

    $parameters = [];
    for ($key = 0; $key < sizeof($currentUrlArray); $key++) {
        if ($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}") {
            array_push($parameters, $currentUrlArray[$key]);
        } elseif ($currentUrlArray[$key] !== $reservedUrlArray[$key]) {
            return false;
        }
    }

    if (helper::methodField() == 'POST') {
        $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
        $parameters = array_merge([$request], $parameters);
    }

    $object = new $class;
    call_user_func_array(array($object, $method), $parameters);
    exit();
}


global $flashMessage;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}


//dashboard

uri("admin", "admin\dashboard", "index");

//category

uri("admin/category", "admin\category", "index");
uri("admin/category/create", "admin\category", "create");
uri("admin/category/store", "admin\category", "store", "POST");
uri("admin/category/edit/{id}", "admin\category", "edit");
uri("admin/category/update/{id}", "admin\category", "update", "POST");
uri("admin/category/delete/{id}", "admin\category", "delete");


//post
uri("admin/post", "post", "index");
uri("admin/post/create", "post", "create");
uri("admin/post/store", "post", "store", "POST");
uri("admin/post/edit/{id}", "post", "edit");
uri("admin/post/update/{id}", "post", "update", "POST");
uri("admin/post/delete/{id}", "post", "delete");
uri("admin/post/show/{id}", "post", "show");
uri("admin/post/edit/braking/{id}", "post", "edit_braking");
uri("admin/post/edit/selected/{id}", "post", "edit_selected");


//user
uri("admin/user", "user", "index");
uri("admin/send_email", "user", "send");
uri("admin/user/edit/{id}", "user", "edit");
uri("admin/user/delete/{id}", "user", "delete");
uri("admin/user/update/{id}", "user", "update", "POST");
uri("admin/user/permission_edit/{id}", "user", "permission_edit");

//comment
uri("admin/comment", "comment", "index");
uri("admin/comment/delete/{id}", "comment", "delete");
uri("admin/user/status_edit_to_approved/{id}", "comment", "status_edit_to_approved");
uri("admin/user/status_edit_to_seen/{id}", "comment", "status_edit_to_seen");

//banner
uri("admin/banner", "banner", "index");
uri("admin/banner/create", "banner", "create");
uri("admin/banner/store", "banner", "store", "POST");
uri("admin/banner/delete/{id}", "banner", "delete");
uri("admin/banner/edit/{id}", "banner", "edit");
uri("admin/banner/update/{id}", "banner", "update", "POST");

//menus
uri("admin/menu", "admin\menu", "index");
uri("admin/menu/create", "admin\menu", "create");
uri("admin/menu/store", "admin\menu", "store", "POST");
uri("admin/menu/delete/{id}", "admin\menu", "delete");
uri("admin/menu/edit/{id}", "admin\menu", "edit");
uri("admin/menu/update/{id}", "admin\menu", "update", "POST");


////app

uri("", "app\index", "index");
uri("about_us", "app\post", "about_us");
uri("news/{id}", "app\post", "index");
uri("post/add_comment/{id}", "app\post", "add_comment", "POST");
uri("captcha", "app\main", "captcha");

uri("test/{id}/{id}", "app\post", "test");


//auth

uri("register", "auth\index", "register");
uri("store", "auth\index", "store","POST");


echo "404";

