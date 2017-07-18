<?php
	
	namespace Database;
	
	class Conn{

		private static $db = null;
		private static $conn = null;
		private static $config = null;

		public static function Create(Array $config = null){
			if(self::$db == null){
				self::$config = $config;
				self::$db = new Conn();
			} 
			if(self::$config == null && self::$db != null){
				self::$config = $config;
			}
			return self::$db;
		}

 		protected function __construct(){}

 		public function Conn(){
 			if(self::$conn == null){
 				if(self::$config == null): die("Passe as Configuraçoes!!"); endif;
 				$config = self::$config;
 				self::$conn = new \PDO("mysql:host=".$config["DB_HOST"].";dbname=".$config["DB_NAME"], $config["DB_USER"], $config["DB_PASS"]);
 			}
 			return self::$conn;
 		}

	}