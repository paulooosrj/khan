<?php

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

		public function params($name){
			return self::$data["params"][$name];
		}

	}