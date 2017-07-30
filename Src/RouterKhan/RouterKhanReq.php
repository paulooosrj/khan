<?php
	
	namespace App\RouterKhan;
	
	/**
	* Request e Response
	*/

	class RouterKhanReq{

		private static $data;

		public function __construct(Array $reqs = array()){
			self::$data = $reqs;
		}

		public function get($name){
			return self::$data["get"][$name];
		}

		public function post($name){
			return self::$data["post"][$name];
		}

		public function put($name){
			return self::$data["put"][$name];
		}

		public function delete($name){
			return self::$data["delete"][$name];
		}

		public function params($name){
			return self::$data["params"][$name];
		}

		public function session($name){
			return self::$data["session"][$name];
		}

	}