<?php
	
	namespace App\Container;

	class ServiceContainer{

		private static $containers = [];
		private static $instance = null;

		public static function Build(){
			if(!self::$instance){
				self::$instance = new ServiceContainer();
			}
			return self::$instance;
		}

		protected function __contruct(){}

		public function set($serviceName, $service){

			if(!isset(self::$containers[$serviceName]) && strlen($serviceName) > 0 && $service){
				self::$containers[$serviceName] = $service;
			}else{
				die("Já existe um servico com esse nome {$serviceName} no Container!!");
			}

		}

		public function get($serviceName){

			if(isset(self::$containers[$serviceName])){
				return self::$containers[$serviceName];
			}else{
				die("Não existe um servico com esse nome {$serviceName} no Container!!");
			}

		}


	}