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

    public function a1()
    {
        echo "a1";
    }
    public function a2()
    {
        echo "a2";
    }
    public function a3()
    {
        echo "a3";
    }
    public function a4()
    {
        echo "a4";
    }
    public function a5()
    {
        echo "a5";
    }
}