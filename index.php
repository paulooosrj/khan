<?php
	
	require __DIR__.'/autoload.php';

	$router = \RouterKhan::getInstance();
	$router->used('views', 'views/');

	$router->get("/", function($req, $res){
		$res->sendStatus(200);
		$res->send("Home, Inicio!!");
	});

	$router->get("/home", function($req, $res){
		$res->sendStatus(200);
		$res->sendFile("home.html");
	});

	$router->params("/home/:meu/:nome", function($req, $res){
		$res->sendStatus(200);
		$res->send($req->params('meu')." ".$req->params('nome'));
		$hello = new Hello();
	});

	$router->post('/cadastro', function($req, $res){
		$res->send("Metodo Post");
		print_r($req->post('nome'));
	});

	$router->Run();