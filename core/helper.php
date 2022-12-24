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

    public static  function methodField()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function url($url){

        $domain = trim(CURRENT_DOMAIN, '/ ');
        $url = $domain . '/' . trim($url, '/')."/";
        return $url;
    }

    protected function redirect($url)
    {
        header('Location: '. trim($this->currentDomain, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    protected function redirectBack()
    {
        header('Location: '. $_SERVER['HTTP_REFERER']);
        exit;
    }
}