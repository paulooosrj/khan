<?php 

	namespace MyApp\Controllers;

	class IndexController{

		public function __construct($application){
			[$req, $res] = $application;
			$res->setContent($req->view()->render('login/home.phtml', [
				"APP" => "http://localhost/RouterKhan",
				"APP_CSS" => "http://localhost/RouterKhan/public/assets/css",
				"APP_JS" => "http://localhost/RouterKhan/public/assets/js",
				"login" => (!empty($_SESSION['id']) && isset($_SESSION['id'])) ? true : false
			]));
			$res->send();
		}

		public static function cadastro($req, $res){
			$res->setContent($req->view()->render('cadastro/home.phtml', [
				"APP" => "http://localhost/RouterKhan",
				"APP_CSS" => "http://localhost/RouterKhan/public/assets/css",
				"APP_JS" => "http://localhost/RouterKhan/public/assets/js",
				"login" => (!empty($_SESSION['id']) && isset($_SESSION['id'])) ? true : false
			]));
			$res->send();
		}

	}