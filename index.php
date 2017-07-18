<?php
	
	require __DIR__.'/autoload.php';

	// Instancia o Router no padrão SINGLETON
	$router = \RouterKhan::getInstance();
	// Define pasta das views para a funcao sendFile assim quando for enviar o arquivo so digitar o nome dele dentro da pasta views/
	$router->used('views', 'views/');

	// Rota Padrão Metodo GET
	$router->get("/", function($req, $res){
		$res->sendStatus(200);
		$res->sendFile("home.html");
	});

	// Rota Usando Metodo POST
	$router->post('/cadastro', function($req, $res){
		$res->send("Metodo Post");
		print_r($req->post('nome'));
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
		$res->send($req->params('meu')." ".$req->params('nome'));
		// Invoca uma classe externa
		// [ O AUTOLOAD FUNCIONA src/NomeDaClass/NomeDaClass.php ] //
		$hello = new Hello();
	});

	$router->Run();