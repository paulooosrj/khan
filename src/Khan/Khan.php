<?php

    /**
     * RouterKhan (Khan.php) - A fast, easy and flexible router system for PHP
     *
     * @author      PaulaoDev <jskhanframework@gmail.com>
     * @copyright   (c) PaulaoDev
     * @link        https://github.com/PaulaoDev/router-khan
     * @license     MIT
     */

    namespace App\Khan;

    use App\Khan\Component\Router\src\Router\Router as Router;
    use App\Khan\Component\Container\ServiceContainer as Container;
    use App\Khan\Component\Stream\StreamServer as Stream;
    use App\Khan\Component\DB\DB as Conn;

class Khan
{

    protected static $instance = null;

    public static function create()
    {
        if (self::$instance == null) {
            self::$instance = new Khan();
        }
        return self::$instance;
    }

    protected function __construct()
    {
    }

    protected function enviroments()
    {
        $dotenv = new \Dotenv\Dotenv(str_replace('src\Khan', '', __DIR__));
        $dotenv->load();
        $this->db = function () {
            return Conn::getConn($_ENV);
        };
    }

    protected function router()
    {

        $container = $this->container;
        $stream = new Stream;
        $db = $this->db;

        $configs = [
          "clean_request" => true,
          "url_filter" => true
        ];

        if(isset($_ENV['APP_SUBDIR']) && !empty($_ENV['APP_SUBDIR'])){
            $configs['sub_dir'] = $_ENV['APP_SUBDIR'];
        }

        Router::create($configs);

        $router = Router::create();

        include_once 'static.php';
        include_once 'Component/Functions/Functions.php';

        foreach (glob("routes/*.php") as $filename) {
            include_once $filename;
        }

        $routerFactory = Router::create();
        $routerFactory->dispatch();
    }

    public function services()
    {

        $this->enviroments();
        $this->container = Container::create();
        $this->router();
    }

    public function dispatch()
    {

        $this->services();
    }
}
