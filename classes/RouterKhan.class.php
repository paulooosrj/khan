<?php
	
	/**
	*  Classe De Rotas [ POST & GET ]
	*/
	class RouterKhan{
		
		private static $instance = null;
		private static $routess = [];
		private static $routessUse = [];

		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new \RouterKhan();
			}
			return self::$instance;
		}

		protected function __construct(){}

		public function used($n, $v){
			self::$routessUse[$n] = $v;
		}

		public function get($name, $callback){
			self::$routess[$name] = $callback;
		}

		public function Run(){
			$getUrl = (empty($_GET["url"])) ? "/" : "/".$_GET["url"];
			if(isset(self::$routess[$getUrl])){
				$fn = self::$routess[$getUrl];
				$fn($req = new Req(),$res = new Res(self::$routessUse));
			}	
		}

	}