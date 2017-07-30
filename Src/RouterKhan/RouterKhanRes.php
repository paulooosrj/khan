<?php
	
	namespace App\RouterKhan;

	// RouterKhan RESPONSE

	class RouterKhanRes{

		private static $use;

		public function __construct($use){
			self::$use = $use;
		}

		public function sendStatus($status){
			http_response_code($status);
		}

		public function send($m){
			echo $m;
		}

		public function sendFile($file){
			include_once (!isset(self::$use["views"])) ? $file : self::$use["views"].$file;
		}

		public function loadView($view, $data){
			extract($data);
			include_once (!isset(self::$use["views"])) ? $view : self::$use["views"].$view;
		}

	}