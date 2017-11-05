<?php
	
	namespace App\Http;
	use Symfony\Component\HttpFoundation\Response;

	/**
	* Response Class and Interface Implement
	*/

	class RouterKhanRes extends Response implements ResponseInterface{

		private static $use = [];

		public function __construct($use){
			parent::__construct();
			self::$use = $use;
		}

		public function sendFile($file){
			include_once (!isset(self::$use["views"])) ? $file : self::$use["views"].$file;
		}

		public function loadView($view, $data){
			extract($data);
			include_once (!isset(self::$use["views"])) ? $view : self::$use["views"].$view;
		}

	}
