<?php
	
	require __DIR__.'/vendor/autoload.php';

	use App\RouterKhan\RouterKhan as Router;
	use App\Container\ServiceContainer as ServiceContainer;

	// Instancia o Router no padrão SINGLETON
	$router = Router::create();
	$container = ServiceContainer::create();

	include_once 'bootstrap/services/default.php';

	$router->get([
		"/" => "MyApp\Controllers\IndexController",
		"/registro" => "MyApp\Controllers\IndexController::cadastro"
	]);

	$router->get([
		"/painel" => "MyApp\Controllers\PainelController",
		"/logout" => "MyApp\Controllers\PainelController::logout"
	]);

	// Validações
	$router->post([
		'/login-auth' => 'MyApp\Controllers\AuthController::login',
		'/register-auth' => 'MyApp\Controllers\AuthController::register'
	]);

	$router->params([
		"/{id}/home/{video_id}" => function($req, $res, $app){
			print_r($req->params());
		}
	]);



	/*
	$router->get('/teste', function(){
		$engine = App\RouterKhan\EngineRegexRouter::create();
		print_r($engine->build([
			'/{id}/home/{video_id}' => function(){}
		], '/PaulaoDev/home/1505807'));
	});

	  
		// Rota Usando Metodo PUT
		$router->put('/update/id', function($req, $res){
			$res->send("Metodo Put, UPDATE ID : ");
			print_r($req->put('id'));
		});

		// Rota Usando Metodo DELETE
		$router->delete('/delete/id', function($req, $res){
			$res->send("Metodo Delete, DELETE ID : ");
			print_r($req->delete('id'));
		});

		// Rota Com Parametro no caso usando 2 parametros
		$router->params("/perfil/{meu}/{nome}", function($req, $res){
			$res->sendStatus(200);
			$res->send($req->params('meu')." ".$req->params('nome')."<br/>");
			// Invoca uma classe externa
			// [ O AUTOLOAD FUNCIONA src/NomeDaClass/NomeDaClass.php ] //
			$hello = new App\Hello\Hello();
		});

		$router->params("/filme/{nome}", function($req, $res){
			$fileName = "resources/video/".$req->params('nome');
			App\Stream\StreamServer::CreateStream($fileName);
		});
	*/

	$router->dispatch($container);