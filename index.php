<?php
	
	require __DIR__.'/autoload.php';
        
        // Instancia o Router No Padrão Singleton
	$router = \RouterKhan::getInstance();

        // Diz para o sistema Usar a Pasta /views para chamar Arquivos Estaticos com o $res->sendFile();
        // Que no caso ficaria $res->sendFile("views/". MEU ARQUIVO CHAMADO NO SENDFILE);
	$router->used('views', 'views/');
        
	// Rota GET Padrão
	$router->get("/", function($req, $res){
		$res->sendStatus(200);
		$res->send("Home, Inicio!!");
	});
        
 	// Rota GET Criada
	$router->get("/home", function($req, $res){
		$res->sendStatus(200);
		$res->sendFile("home.html");
	});

	// Rota com PARAMETROS
	$router->params("/home/:meu/:nome", function($req, $res){
		$res->sendStatus(200);
		$res->send($req->params('meu')." ".$req->params('nome'));
		$hello = new Hello();
	});
        
	// Rota POST Criada
	$router->post('/cadastro', function($req, $res){
		$res->send("Metodo Post");
		print_r($req->post('nome'));
	});
        
	// Inicia o Router
	$router->Run();
