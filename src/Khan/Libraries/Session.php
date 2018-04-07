<?php

	namespace App\Khan\Libraries;

	@session_start();

	class Session {

		public static function has($name){
			if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
				return true;
			}
		}

		public static function set($name, $value){
			if(!isset($_SESSION[$name]) && empty($_SESSION[$name])){
				$_SESSION[$name] = $value;
			}
		}

		public static function get($name){
			if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
				return $_SESSION[$name];
			}
		}

		public static function remove($name){
			if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
				unset($_SESSION[$name]);
			}
		}

		public static function removeAll(){
			session_destroy();
		}

	}
