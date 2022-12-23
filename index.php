<?php

require_once "autoloder.php";



const DB_SERVER = "localhost";
const DB_NAME = "project";
const DB_USER = "root";
const DB_PASS = "";

//config
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN',helper::currentDomain() . '/news_site_oop');





/*new database();*/


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

    if(sizeof($currentUrlArray) != sizeof($reservedUrlArray) || helper::methodField() != $requestMethod)
    {
        return false;
    }

    $parameters = [];
    for($key = 0; $key < sizeof($currentUrlArray); $key++)
    {
        if($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}")
        {
            array_push($parameters, $currentUrlArray[$key]);
        }
        elseif($currentUrlArray[$key] !== $reservedUrlArray[$key])
        {
            return false;
        }
    }

    if(helper::methodField() == 'POST')
    {
        $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
        $parameters = array_merge([$request], $parameters);
    }

    $object = new $class;
    call_user_func_array(array($object, $method), $parameters);
    exit();
}

uri("database/creat","database","a");
uri("mmd/a1","helper","a1");
uri("ali/a1","helper","a1");



