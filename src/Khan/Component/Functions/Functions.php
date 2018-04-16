<?php

function redirect($url)
{

    header("Location: {$url}");
}

function view($url)
{

    return 'resources/views/' . $url;
}

function assets($url)
{

    return $_ENV['APP_URL']. "/" . "public" . $url;
}

    /**
     * CLASSES FUNCTIONS
     */

class Router
{

    public static function __callStatic($name, $arguments)
    {
        $routerrr = App\Khan\Component\Router\src\Router\Router::create();
        call_user_func_array([$routerrr, $name], $arguments);
    }
}

class Container
{

    public static function __callStatic($name, $arguments)
    {
        $containerrr = App\Khan\Component\Container\ServiceContainer::create();
        call_user_func_array([$containerrr, $name], $arguments);
    }
}

class DB
{

    public static function __callStatic($name, $arguments)
    {
        $dbb = App\Khan\Component\DB\DB::getConn($_ENV);
        call_user_func_array([$dbb, $name], $arguments);
    }
}
