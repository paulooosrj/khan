<?php

	namespace MyApp;
	use App\RouterKhan\Component\Container\ServiceContainer as Container;
	use App\RouterKhan\Component\Stream\StreamServer as Stream;
	use App\RouterKhan\Component\DB\DB as Database;

	class HomeController {

		public function index($req, $res, $db){
			echo 'Ola mundo!!'.
		}

		public function getDB(){
			return Database::getConn();
		}

	}
