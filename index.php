<?php

require_once "autoloder.php";


date_default_timezone_set("Asia/Tehran");

const DB_SERVER = "localhost";
const DB_NAME = "project";
const DB_USER = "root";
const DB_PASS = "";

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

//category

uri("admin/category", "category", "index");
uri("admin/category/create", "category", "create");
uri("admin/category/store", "category", "store","POST");
uri("admin/category/edit/{id}", "category", "edit");
uri("admin/category/update/{id}", "category", "update","POST");
uri("admin/category/delete/{id}", "category", "delete");


//post
uri("admin/post", "post", "index");
uri("admin/post/create", "post", "create");
uri("admin/post/store", "post", "store","POST");
uri("admin/post/edit/{id}", "post", "edit");
uri("admin/post/update/{id}", "category", "update","POST");
uri("admin/post/delete/{id}", "post", "delete");
uri("admin/post/show/{id}", "post", "show");
uri("admin/post/edit/braking/{id}", "post", "edit_braking");
uri("admin/post/edit/selected/{id}", "post", "edit_selected");


//user
uri("admin/user", "user", "index");
uri("admin/user/edit/{id}", "user", "edit");
uri("admin/user/delete/{id}", "user", "delete");
uri("admin/user/update/{id}", "user", "update","POST");
uri("admin/user/permission_edit/{id}", "user", "permission_edit");




echo "404";

