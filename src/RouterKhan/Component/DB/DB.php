<?php

	namespace App\RouterKhan\Component\DB;
	// Usando Medoo namespace
	use Medoo\Medoo;

	class DB {

		private static $db = null;

		public static function getConn($env){
			if(self::$db === null){
				self::$db = new Medoo([
					'database_type' => $env['DB_CONNECTION'],
					'database_name' => $env['DB_DATABASE'],
					'server' => $env['DB_HOST'],
					'username' => $env['DB_USERNAME'],
					'password' => $env['DB_PASSWORD'],
					'charset' => $env['DB_CHARSET']
				]);
			}
			return self::$db;
		}

	}
