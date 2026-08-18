<?php

namespace App\Core;

class Request
{
    //base path
    public static function base()
    {
        return trim(dirname($_SERVER['SCRIPT_NAME']), '/');
    }

    //base url
    public static function baseurl()
    {
        //check if ssl
        if (!self::secure()) {
            return 'http://' . $_SERVER['HTTP_HOST'] . '/' . self::base();
        } else {
            return 'https://' . $_SERVER['HTTP_HOST'] . '/' . self::base();
        }
    }

    //input
    public static function input($key = null)
    {
        //check if key exist is any of the request
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }
        //return null
        return null;
    }

    //all
    public static function all()
    {
        return $_REQUEST;
    }

    //uri
    public static function uri()
    {
        //check if ssl
        if (!self::secure()) {
            $t = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            //get base
            $b = self::base();
            //check if base is in uri
            if (strpos($t, $b) === 0) {
                $t = substr($t, strlen($b));
            }
            return $t ?: '/';
        } else {
            return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        }
    }

    //ssl
    public static function secure()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
    }

    //method
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    //is post
    public static function isPost()
    {
        return self::method() == 'POST';
    }

    //is get
    public static function isGet()
    {
        return self::method() == 'GET';
    }

    //is ajax
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    //is PUT
    public static function isPut()
    {
        return self::method() == 'PUT';
    }

    //is DELETE
    public static function isDelete()
    {
        return self::method() == 'DELETE';
    }

    //is PATCH
    public static function isPatch()
    {
        return self::method() == 'PATCH';
    }

    //is any
    public static function isAny()
    {
        return self::isPost() || self::isGet() || self::isPut() || self::isDelete() || self::isPatch();
    }
}
