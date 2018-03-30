<?php

	/**
	 * RouterKhan (Khan.php) - A fast, easy and flexible router system for PHP
	 *
	 * @author      PaulaoDev <jskhanframework@gmail.com>
	 * @copyright   (c) PaulaoDev 
	 * @link        https://github.com/PaulaoDev/router-khan
	 * @license     MIT
	 */

	namespace App\RouterKhan;
	use App\RouterKhan\Component\Router\src\Router\Router as Router;
	use App\RouterKhan\Component\Container\ServiceContainer as Container;
	use App\RouterKhan\Component\Stream\StreamServer as Stream;
	use App\RouterKhan\Component\DB\DB as Conn;

	class Khan{

		protected static $instance = null;

		public static function create(){
			if(self::$instance == null){
				self::$instance = new Khan();
			}
			return self::$instance;
		}

		protected function __construct(){}

		protected function enviroments(){
			$dotenv = new \Dotenv\Dotenv(str_replace('src\RouterKhan', '', __DIR__));
			$dotenv->load();
			$this->db = Conn::getConn($_ENV);
		}

		protected function router(){

			$container = $this->container;
			$stream = new Stream;
			$db = $this->db;

			$router = Router::create([
		      "clean_request" => true,
		      "url_filter" => true
		    ]);

			foreach (glob("routes/*.php") as $filename){
			    include_once $filename;
			}

			$router->dispatch();

		}

		public function services(){

			$this->enviroments();
			$this->container = Container::create();
			$this->router();

		}

		public function dispatch(){

			$this->services();

		}

	}
