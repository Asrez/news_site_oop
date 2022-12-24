<?php


class helper
{

    public static function protocol()
    {
        return stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
    }


    public static function currentDomain()
    {
        return self::protocol() . $_SERVER['HTTP_HOST'];
    }


    public static function currentUrl()
    {
        return self::currentDomain() . $_SERVER['REQUEST_URI'];
    }

    public static function methodField()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function url($url)
    {

        $domain = trim(CURRENT_DOMAIN, '/ ');
        $url = $domain . '/' . $url;
        return $url;
    }

    public static function redirect($url)
    {
        header('Location: '. trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    public static function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }


    public static function dd($var)
    {
        echo '<pre>';
        var_dump($var);
        exit;
    }


}