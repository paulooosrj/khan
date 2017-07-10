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

	$router->Run();