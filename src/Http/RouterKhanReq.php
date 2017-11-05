<?php
	
	namespace App\Http;
	use Symfony\Component\HttpFoundation\Request;

	/**
	* Request Class and Interface Implement
	*/


	class RouterKhanReq extends Request implements RequestInterface{

		private static $data = [];

		public function __construct(Array $reqs = array(), $uri = ''){
			$this->makeRequests();
			parent::__construct($_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER);
			self::$data = $reqs;
			$this->current_uri = $uri;
			$this->class_name = __CLASS__;
		}

		public function makeRequests(){
			if(is_null($_GET)): $_GET = []; endif;
			if(is_null($_POST)): $_POST = []; endif;
			if(isset($_PUT) && is_null($_PUT)): $_PUT = []; endif;
			if(isset($_DELETE) && is_null($_DELETE)): $_DELETE = []; endif;
			if(is_null($_SERVER)): $_SERVER = []; endif;
			if(is_null($_COOKIE)): $_COOKIE = []; endif;
			if(is_null($_FILES)): $_FILES = []; endif;
		}

		/* 
			public function get($name = null){
				if($name == null){
					return self::$data["get"];
				}else{
					return self::$data["get"][$name];
				}
			}
		*/
		public static function validateValue($type, $value){
			return in_array($value, self::$data[$type]);
		}

		public static function validateType($type, $value){
			$retorno = '';
			if(in_array($type, self::$data)){
				$retorno = RouterKhanReq::validateValue($type, $value);
			}
			return $retorno;
		}

		public static function post(string $name = null){
			$validate = RouterKhanReq::validateValue("post", $name);
			if($validate && $name !== null){ return false; }
			if($name == null){
				return self::$data["post"];
			}else{
				return self::$data["post"][$name];
			}
			return false;
		}

		public static function files(string $name = null){
			$validate = RouterKhanReq::validateValue("files", $name);
			if($validate && $name !== null){ return false; }
			if($name == null){
				return self::$data["files"];
			}else{
				return self::$data["files"][$name];
			}
			return false;
		}

		public static function put(string $name = null){
			$validate = RouterKhanReq::validateValue("put", $name);
			if($validate && $name !== null){ return false; }
			if($name == null){
				return self::$data["put"];
			}else{
				return self::$data["put"][$name];
			}
			return false;
		}

		public static function delete(string $name = null){
			$validate = RouterKhanReq::validateValue("delete", $name);
			if($validate && $name !== null){ return false; }
			if($name == null){
				return self::$data["delete"];
			}else{
				return self::$data["delete"][$name];
			}
			return false;
		}

		public static function params(string $name = null){
			$validate = RouterKhanReq::validateValue("params", $name);
			if($validate && $name !== null){ return false; }
			if($name == null){
				return self::$data["params"];
			}else{
				return self::$data["params"][$name];
			}
			return false;
		}

		public static function session(string $name = null){
			$validate = RouterKhanReq::validateValue("session", $name);
			if($validate && $name !== null){ return false; }
			if($name == null){
				return self::$data["session"];
			}else{
				return self::$data["session"][$name];
			}
			return false;
		}

	}
