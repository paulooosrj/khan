<?php

	/**
	 * RouterKhan (RouterKhan.php) - A fast, easy and flexible router system for PHP
	 *
	 * @author      PaulaoDev <jskhanframework@gmail.com>
	 * @copyright   (c) PaulaoDev 
	 * @link        https://github.com/PaulaoDev/router-khan
	 * @license     MIT
	 */

	namespace App\RouterKhan;
	use App\Http\{
		EngineRegexRouter as EngineRegexRouter,
		RouterKhanReq as RouterKhanReq,
		RouterKhanRes as RouterKhanRes
	};
	
	session_start();

	class RouterKhan{
		
		private static $instance = null;
		public static $delete;
		public static $put;
		private static $routess = array(
			"get" => array(),
			"post" => array(),
			"params" => array(),
			"delete" => array(),
			"put" => array(),
			"patch" => array()
		);
		private static $routes_use = [];
		private static $routes_params = array();
		private static $config = [];
		protected static $method;

		public static function create($fileConfig = ''){
			if(self::$instance == null){
				self::$instance = new RouterKhan($fileConfig);
			}
			return self::$instance;
		}

		protected function __construct($fileConfig){

			$this->engine = EngineRegexRouter::create();
			$this->uri = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			self::$method = strtolower($_SERVER['REQUEST_METHOD']);

			if(file_exists('config/config.json')){
				self::$config = json_decode(file_get_contents('config/config.json'), true);
			}
			if (self::$method == 'delete') {
    				parse_str(file_get_contents('php://input'), self::$delete);
			}
			if (self::$method == 'put') {
    				parse_str(file_get_contents('php://input'), self::$put);
			}
		}

		public function filterRequests(){
			$_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
			$_GET = filter_input_array(INPUT_GET, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
		}

		public function get($name, $callback = null){
			$type = gettype($name);
			if($type == "string"){
				self::$routess["get"][$name] = $callback;
			}elseif($type == "array"){
				foreach ($name as $key => $routeName) {
					if($callback == null){
						self::$routess["get"][$key] = $name[$key];
					}else{
						self::$routess["get"][$key] = $callback;
					}
				}
			}
		}

		public function post($name, $callback = null){
			$type = gettype($name);
			if($type == "string"){
				self::$routess["post"][$name] = $callback;
			}elseif($type == "array"){
				foreach ($name as $key => $routeName) {
					if($callback == null){
						self::$routess["post"][$key] = $routeName;
					}else{
						self::$routess["post"][$key] = $callback;
					}
				}
			}
		}

		public function put($name, $callback = null){
			$type = gettype($name);
			if($type == "string"){
				self::$routess["put"][$name] = $callback;
			}elseif($type == "array"){
				foreach ($name as $key => $routeName) {
					if($callback == null){
						self::$routess["put"][$key] = $routeName;
					}else{
						self::$routess["put"][$key] = $callback;
					}
				}
			}
		}

		public function delete($name, $callback = null){
			$type = gettype($name);
			if($type == "string"){
				self::$routess["delete"][$name] = $callback;
			}elseif($type == "array"){
				foreach ($name as $key => $routeName) {
					if($callback == null){
						self::$routess["delete"][$key] = $routeName;
					}else{
						self::$routess["delete"][$key] = $callback;
					}
				}
			}
		}

		public function params($name, $callback = null){
			$type = gettype($name);
			if($type == "string"){
				self::$routess["params"][$name] = $callback;
			}elseif($type == "array"){
				foreach ($name as $key => $routeName) {
					if($callback == null){
						self::$routess["params"][$key] = $routeName;
					}else{
						self::$routess["params"][$key] = $callback;
					}
				}
			}
		}

		public static function redirect($uri1, $uri2){

		}

		public static function merge($ob1, $ob2){
			return new class($ob1, $ob2) {

				public function __construct($o1, $o2){
					foreach ($o1 as $key => $value) {
						$this->$key = $value;
					}
					foreach ($o2 as $key => $value) {
						$this->$key = $value;
					}
				}

				public function __set($method, $value) {
				    if (method_exists($this, $method)) {
				        throw new Exception("Unrecognized attribute '$method'");
				    }
				    else{
				    	$this->$method = $value;
				    }
				}

				public function __call($name, $args = []){
			        return call_user_func_array($this->$name, $args);
			    }

			};
			//return $obj_merged = (object) array_merge((array) $ob1, (array) $ob2);
		}

		public static function verify($ob1, $ob2){
			foreach ($ob2 as $key => $method) {
				if(!method_exists($ob1, $method)){
					$ob1->$method = $ob1->class_name."::".$method;
				}
			}
			return $ob1;
		}

		//print_r(teste('/{teste}/aqui/{dnv}', '/mundo/agora/aqui'));

		public function middlewaresConfig($config){
			foreach ($config as $key => $value) {
				self::$routes_use[$key] = call_user_func($value, '');
			}
		}

		public function classInvoked($string, $data){
			$class = $string;
			$finish = '';
			if(strripos($class, "@")){
				[$className, $fun] = explode('@', $class);
				$finish = new $className;
				call_user_func_array([$finish, $fun], $data);
			}
			elseif(strripos($class, "::")){
				call_user_func_array($class, $data);
			}
			else{
				new $class($data);
			}
		}

		private function CallbackTrate($type, $callback, $data){
			if($type == "object"){
				call_user_func_array($callback, $data);
			}
			elseif($type == "string"){
				$this->classInvoked($callback, $data);
			}
		}

		private function trateCallback($callback, $data){
			$type = gettype($callback);
			if($type == "object"){
				$this->CallbackTrate($type, $callback, $data);
			}
			elseif($type == "string"){
				$this->CallbackTrate($type, $callback, $data);
			}
			elseif($type == "array"){
				foreach ($callback as $key => $value) {
					$t = gettype($value);
					$this->CallbackTrate($t, $value, $data);
				}
			}
		}

		public function dispatch($services = null){
			// Limpas As Requisiçoes
			if(self::$config['clean_request']){
				$this->filterRequests();
			}
			// Pega Url Amigavel do navegador
			$uri = (empty($_GET["url"])) ? self::$config["root"] : "/".$_GET["url"];
			// Filtra URL
			if(self::$config["url_filter"]){
				$uri = strip_tags(addslashes($uri));
			}
			// Pega metodo da requisiçao
			$method = self::$method;
			// Verifica se é rota com parametro
			$param_receive = $this->engine->build(self::$routess["params"], $uri);
			// Roda middleware
			$instance = $this;
			$work = function($dataReceive, $uri) use($services, $instance){
				$services = $services();
				$req = new RouterKhanReq($dataReceive, $uri);
				$reflect = get_class_methods($req);
				unset($reflect[0]);
				$req = RouterKhan::merge($req, $services);
				$req = RouterKhan::verify($req, $reflect);
				return [$req, new RouterKhanRes(self::$routes_use)];
			};
			// Informa metodo como param
			if(count($param_receive) > 0 && is_array($param_receive)){ 
				$method = "param"; 
			}
			if($method == "get" && isset(self::$routess["get"][$uri])){
					// Verifica se é rota GET
					$fn = self::$routess["get"][$uri];
					$dataReceive = array(
						"get" => $_GET,
						"session" => $_SESSION
					);
					if($services !== null){
						$data = $work($dataReceive, $this->uri);
					}else{
						$req = new RouterKhanReq($dataReceive, $this->uri);
						$data = [
							$req, 
							new RouterKhanRes(self::$routes_use)
						];
					}
					$this->trateCallback($fn, $data);
			} elseif($method == "post" && isset(self::$routess["post"][$uri])){ 
				    // Verifica se é rota POST
					$fn = self::$routess["post"][$uri];
					$dataReceive = array(
						"get" => $_GET, 
						"post" => $_POST,
						"session" => $_SESSION,
						"files" => $_FILES
					);
					if($services !== null){
						$data = $work($dataReceive, $this->uri);
					}else{
						$data = [
							new RouterKhanReq($dataReceive, $this->uri), 
							new RouterKhanRes(self::$routes_use)
						];
					}
					$this->trateCallback($fn, $data);
			} elseif($method == "delete" && isset(self::$routess["delete"][$uri])){
					// Verifica metodo DELETE 
					$fn = self::$routess["delete"][$uri];
					$dataReceive = array(
						"delete" => self::$delete,
						"session" => $_SESSION,
						"files" => $_FILES
					);
					if($services !== null){
						$data = $work($dataReceive, $this->uri);
					}else{
						$data = [
							new RouterKhanReq($dataReceive, $this->uri), 
							new RouterKhanRes(self::$routes_use)
						];
					}
					$this->trateCallback($fn, $data);
			} elseif($method == "put" && isset(self::$routess["put"][$uri])){ 
					// Verifica metodo PUT
					$fn = self::$routess["put"][$uri];
					$dataReceive = array(
						"put" => self::$put,
						"session" => $_SESSION,
						"files" => $_FILES
					);
					if($services !== null){
						$data = $work($dataReceive, $this->uri);
					}else{
						$data = [
							new RouterKhanReq($dataReceive, $this->uri), 
							new RouterKhanRes(self::$routes_use)
						];
					}
					$this->trateCallback($fn, $data);
			} elseif($method == "param" && count($param_receive) > 0){
				//print_r(self::$routesParameter); 
				// Verifica se é rota com parametro
				$fn = self::$routess["params"][$param_receive["rota"]];
				$paramReceive = $param_receive["params"];
				$dataReceive = array(
					"post" => $_POST,
					"get" => $_GET,
					"params" => $paramReceive,
					"session" => $_SESSION
				);
				//print_r($dataReceive);
				if($services !== null){
					$data = $work($dataReceive, $this->uri);
				}else{
					$data = [
						new RouterKhanReq($dataReceive, $this->uri), 
						new RouterKhanRes(self::$routes_use)
					];
				}
				$this->trateCallback($fn, $data);
			} else{  
				// Rota Caso não Exista ROTA
				if(
					self::$config["file_error"] && 
					file_exists(self::$config["file_error"])
				){
					include self::$config["file_error"];
				}
				http_response_code(404);
			}
		}
	}