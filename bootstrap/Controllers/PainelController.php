<?php 

	namespace MyApp\Controllers;

	class PainelController{

		public function __construct($application){
			[$req, $res] = $application;
			$folders = $req->app();
			$folders = [
				"APP" => $folders(),
				"APP_CSS" => $folders->css(),
				"APP_JS" => $folders->js()
			];
			$data = array_merge($folders, $req->session());
			$data = array_merge($data, [
				"image" => $req->session('icone'),
				"login" => (!empty($_SESSION['id']) && isset($_SESSION['id'])) ? true : false
			]);
			$res->setContent($req->view()->render('painel/home.phtml', $data));
			$res->send();
		}

		public static function logout($req, $res){
			$req->Session()::removeAll();
			if($_SESSION['id']){
				$req->Session()::removeAll();
				header("Location: ./");
			}else{
				header("Location: ./");
			}
		}

	}