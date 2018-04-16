<?php 
			
		 /**
		 * Khan - Component (Router) - A fast, easy and flexible router system for PHP
		 *
		 * @author      PaulaoDev <jskhanframework@gmail.com>
		 * @copyright   (c) PaulaoDev 
		 * @link        https://github.com/PaulaoDev/Router
		 * @license     MIT
		 */
    
      namespace App\Khan\Component\Router\src\Router;
			use App\Khan\Component\Router\src\Http\Response as Response;
			use App\Khan\Component\Router\src\Http\Request as Request;
      use App\Khan\Component\Container\ServiceContainer as Container;
      use App\Khan\Component\Stream\StreamServer as Stream;
      use App\Khan\Component\DB\DB as Conn;

			@session_start();

      class Responser {
          public function __construct(){
            $this->container = Container::create();
            $this->stream = new Stream;
            $this->db = function(){
              return Conn::getConn($_ENV);
            };
            $self = $this;
          }

          public function helpers(){
              foreach (func_get_args() as $key => $helper) {
                  $name = "App\Khan\Libraries"."\\".$helper;
                  $this->$helper = new $name;
              }
          }

      }

      class Router {
        
          use \KhanComponent\RegexEngine\RegexEngine;
        
          private static $instance = null,
												 $uses = [],
                         $routes = [],
                         $config = [],
                         $delete, $put;
        
          public static function create($config = ''){
              if(self::$instance === null){
                 self::$instance = new self($config);
              }
              return self::$instance;
          }
        
          protected function __construct($config = null){
              $server = $_SERVER;
              self::$config["uri"] = Router::get_uri();
              self::$config["path"] = (strripos($server["REQUEST_URI"], "?")) ? explode("?", $server["REQUEST_URI"])[0] : $server["REQUEST_URI"];
              if(isset($config['sub_dir']) && !empty($config['sub_dir'])){ self::$config["path"] = str_replace($config['sub_dir'], '', self::$config["path"]); }
              self::$config["method"] = (isset($server["REQUEST_METHOD"])) ? $server["REQUEST_METHOD"] : "GET";
              if(in_array(self::$config["method"], ["delete","put"])){
                if(self::$config["method"] === "delete"):
									parse_str(file_get_contents('php://input'), self::$delete);
								endif;
								if(self::$config["method"] === "put"):
									parse_str(file_get_contents('php://input'), self::$put);
								endif;
              }
              if(!is_null($config) && gettype($config) == "array"){
                self::$config = array_merge(self::$config, $config);
              }
          }
        
          public static function get_uri(){
              $server = $_SERVER;
              $protocol = (isset($server["REQUEST_SCHEME"])) ? $server["REQUEST_SCHEME"] : ((isset($server["HTTP_X_FORWARDED_PROTO"])) ? $server["HTTP_X_FORWARDED_PROTO"] : "http");
              $domain = (isset($server['HTTP_HOST'])) ? $server['HTTP_HOST'] : $server["SERVER_NAME"];
              $path = (isset($server["REQUEST_URI"])) ? $server["REQUEST_URI"] : "/";
              return "{$protocol}://{$domain}{$path}";
          }

          public static function methods(){
            return self::$routes;
          }
        
          public static function clean_request(){
              $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
			        $_GET = filter_input_array(INPUT_GET, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
          }
        
          public static function has($route, $type){
              return !isset(self::$routes[$type][$route]);
          }
        
          public static function type($type){
              return gettype($type);
          }
				
					public function set($name, $callback){
							if(!isset(self::$uses[$name])){
								self::$uses[$name] = $callback;
							}
					}
				
					private function uses(){
						return self::$uses;
					}
        
          public function class_invoked($string, $data){
              $class = $string;
              $finish = '';
              if(strripos($class, "@")){
                list($className, $fun) = explode('@', $class);
                $finish = new $className;
                echo call_user_func_array([$finish, $fun], $data);
              }
              elseif(strripos($class, "::")){
                echo call_user_func_array($class, $data);
              }
              else{
                new $class($data);
              }
          }

          public function callBind(){
            return new Responser;
          }
        
          private function type_trate($type, $callback, $data){
              if($type == "object"){
                $callback = $callback->bindTo($this->callBind());
                echo call_user_func_array($callback, $data);
              }
              elseif($type == "string"){
                //$callback = $callback->bindTo(Container::class, Stream::class);
                $this->class_invoked($callback, $data);
              }
          }
        
          private function trate_callback($callback, $data){
              $type = gettype($callback);
              if($type == "object"){
                $this->type_trate($type, $callback, $data);
              }
              elseif($type == "string"){
                $this->type_trate($type, $callback, $data);
              }
              elseif($type == "array"){
                foreach ($callback as $key => $value) {
                  $t = gettype($value);
                  $this->type_trate($t, $value, $data);
                }
              }
          }

          public static function redirect($route, $args){
              header("Location: {$route}");
          }
        
          public static function get($route, $call = null, $method = 'GET'){
               $scope = Router::create();
               if(Router::has($route, $method)){
                  $type = Router::type($route);
                  if($type === "string"){
                    self::$routes[$method][$route] = $call;
                  } elseif($type === "array"){
                    foreach ($route as $key => $routeName) {
                      if($callback == null){
                        self::$routess[$method][$key] = $routeName;
                      }else{
                        self::$routess[$method][$key] = $callback;
                      }
                    }
                  }
               }
              return $scope;
          }
        
          public static function post($route, $call = null, $method = 'POST'){
              $scope = Router::create();
               if(Router::has($route, $method)){
                  $type = Router::type($route);
                  if($type === "string"){
                    self::$routes[$method][$route] = $call;
                  } elseif($type === "array"){
                    foreach ($route as $key => $routeName) {
                      if($callback == null){
                        self::$routess[$method][$key] = $routeName;
                      }else{
                        self::$routess[$method][$key] = $callback;
                      }
                    }
                  }
               }
              return $scope;
          }
        
          public static function delete($route, $call = null, $method = 'DELETE'){
               if(Router::has($route, $method)){
                  $type = Router::type($route);
                  if($type === "string"){
                    self::$routes[$method][$route] = $call;
                  } elseif($type === "array"){
                    foreach ($route as $key => $routeName) {
                      if($callback == null){
                        self::$routess[$method][$key] = $routeName;
                      }else{
                        self::$routess[$method][$key] = $callback;
                      }
                    }
                  }
               }
              return $scope;
          }
        
          public static function put($route, $call = null, $method = 'PUT'){
              $scope = Router::create();
               if(Router::has($route, $method)){
                  $type = Router::type($route);
                  if($type === "string"){
                    self::$routes[$method][$route] = $call;
                  } elseif($type === "array"){
                    foreach ($route as $key => $routeName) {
                      if($callback == null){
                        self::$routess[$method][$key] = $routeName;
                      }else{
                        self::$routess[$method][$key] = $callback;
                      }
                    }
                  }
               }
              return $scope;
          }

          public static function respond($route, $call = null, $method = 'RESPOND'){
               $scope = Router::create();
               if(Router::has($route, $method)){
                  $type = Router::type($route);
                  if($type === "string"){
                    self::$routes[$method][$route] = $call;
                  } elseif($type === "array"){
                    foreach ($route as $key => $routeName) {
                      if($callback == null){
                        self::$routess[$method][$key] = $routeName;
                      }else{
                        self::$routess[$method][$key] = $callback;
                      }
                    }
                  }
               }
              return $scope;
          }

          public function isRespond($key, $uri){
              $key = '/^' . str_replace('/', '\/', $key) . '$/';
              $matches = [];
              return (preg_match($key, $uri, $matches)) ? $matches : false;
          }
        
          public static function params($route, $call = null, $method = 'PARAMS'){
             $scope = Router::create();
             if(Router::has($route, $method)){
                $type = Router::type($route);
                if($type === "string"){
                  self::$routes[$method][$route] = $call;
                } elseif($type === "array"){
                  foreach ($route as $key => $routeName) {
                    if($callback == null){
                      self::$routess[$method][$key] = $routeName;
                    }else{
                      self::$routess[$method][$key] = $callback;
                    }
                  }
                }
             }
            return $scope;
          }

        public function makeData($params = ''){
            $data_receive = [
                "post" => $_POST,
                "get" => $_GET,
                "params" => (is_array($params)) ? $params : [],
                "session" => $_SESSION,
                "files" => $_FILES,
                "put" => (is_array(self::$put)) ? self::$put : [],
                "delete" => (is_array(self::$delete)) ? self::$delete : []
            ];
            return $data_receive;
        }

        public function respondRouter($fn, $data_receive, $inject = []){
            $data = array_merge([
                new Request($data_receive, Router::get_uri()),
                new Response(self::$uses),
                'db' => function(){
                    return Conn::getConn($_ENV);
                }
            ], $inject);
            $this->trate_callback($fn, $data);
        }
        
        public function dispatch(){
          
            $uri = self::$config["path"];
            
            $metodo = self::$config["method"];
						$param_receive = false;

            if(in_array('RESPOND', array_keys(self::$routes))){
                foreach (self::$routes["RESPOND"] as $key => $fn) {
                    if($this->isRespond($key, $uri)){
                       $fn = self::$routes["RESPOND"][$key];
                       $this->respondRouter(
                          $fn, 
                          $this->makeData(), 
                          ["reg" => $this->isRespond($key, $uri)]
                      );
                    }
                }
            }
					
						if(in_array('PARAMS', array_keys(self::$routes))){
							$param = $this->build(self::$routes["PARAMS"], $uri);
							if(is_array($param)){
								$param_receive = $param;
								$metodo = "PARAMS";
							}
						}
          
            // Limpa Request [ GET & POST]
            if(in_array("clean_request", array_keys(self::$config))){
							if(self::$config["clean_request"]): Router::clean_request(); endif;
            }
          
            // Limpa URL
						if(in_array("url_filter", array_keys(self::$config))){
							if(self::$config["url_filter"]): $uri = strip_tags(addslashes($uri)); endif;
            }
            
            if(in_array($metodo, array_keys(self::$routes))){
							
							if(in_array($uri, array_keys(self::$routes[$metodo])) || in_array($param_receive["rota"], array_keys(self::$routes[$metodo]))){
									
                  $data_receive = $this->makeData($param_receive['params']);

									$fn = '';

									if(is_array($param_receive)){
										$fn = self::$routes[$metodo][$param_receive['rota']];
									}else{
										$fn = self::$routes[$metodo][$uri];
									}

									$this->respondRouter($fn, $data_receive);

							}
						}
            
        }
        
        
      }
