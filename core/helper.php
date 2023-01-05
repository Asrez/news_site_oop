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
        $url = $domain . '/' . trim($url, '/');
        return $url;
    }

    public static function redirect($url)
    {
        header('Location: ' . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
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

    public static function limit_word(string $string, int $limit)
    {
        $string = trim($string, " ");
        $array_text = explode(" ", $string);
        $array_text = array_slice($array_text, 0, $limit);
        return implode(" ", $array_text);
    }

    public static function saveImage($image, $imagePath, $imageName = null)
    {

        if ($imageName) {
            $extension = explode('/', $image['type'])[1];
            $imageName = $imageName . '.' . $extension;
        } else {
            $extension = explode('/', $image['type'])[1];
            $imageName = date("Y-m-d-H-i-s") . '.' . $extension;
        }

        $imageTemp = $image['tmp_name'];
        $imagePath = 'public/' . $imagePath . '/';

        if (is_uploaded_file($imageTemp)) {
            if (move_uploaded_file($imageTemp, $imagePath . $imageName)) {
                return $imagePath . $imageName;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public static function removeImage($path)
    {
        $path = trim($path, '/ ');
        if (file_exists($path)) {
            unlink($path);
        }
    }



    public static function flash($name, $value = null)
    {
        if($value === null){
            global $flashMessage;
            $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
            return $message;
        }
        else{
            $_SESSION['flash_message'][$name] = $value;
        }
    }

    public static function get_real_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }



}