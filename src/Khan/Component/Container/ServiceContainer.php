<?php
    
    namespace App\Khan\Component\Container;

    use stdClass;
    use Closure;

class ServiceContainer
{

    private static $containers = [];
    private static $instance = null;

    public static function create()
    {
        if (!self::$instance) {
            self::$instance = new ServiceContainer();
        }
        return self::$instance;
    }

    protected function __contruct()
    {
    }

    public static function bind($serviceName, $service)
    {
        if (!ServiceContainer::has($serviceName) && strlen($serviceName) > 0 && $service) {
            self::$containers[$serviceName] = $service;
        } else {
            die("Já existe um servico {$serviceName} no Container!!");
        }
    }

    public static function get($serviceName)
    {
        if (ServiceContainer::has($serviceName)) {
            return self::$containers[$serviceName];
        } else {
            die("Não existe servico com esse nome {$serviceName} no Container!!");
        }
    }

    public static function has($serviceName)
    {
        return isset(self::$containers[$serviceName]);
    }

    public function __set($serviceName, $service)
    {
        if (!ServiceContainer::has($serviceName) && strlen($serviceName) > 0 && $service) {
            self::$containers[$serviceName] = $service;
        } else {
            die("Já existe um servico {$serviceName} no Container!!");
        }
    }

    public function __get($serviceName)
    {
        if (ServiceContainer::has($serviceName)) {
            return self::$containers[$serviceName];
        } else {
            die("Não existe servico com esse nome {$serviceName} no Container!!");
        }
    }

    public function __invoke()
    {
        $class_cache = new stdClass;
        foreach (self::$containers as $key => $value) {
            $class_cache->$key = $value;
        }
        print_r($class_cache);
        return $class_cache;
    }
}
