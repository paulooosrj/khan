<?php
	
	require __DIR__.'/autoload.php';

	use RouterKhan\RouterKhan as Router;

	// Instancia o Router no padrão SINGLETON
	$router = Router::getInstance();
	$container = Container\ServiceContainer::Build();
	$db = Database\Conn::setConfig([
		"DB_HOST" => "localhost",
		"DB_NAME" => "clinica",
		"DB_USER" => "root",
		"DB_PASS" => ""
	]);
	$container->set('meu_database', Database\Conn::Conexao());

	// Define pasta das views para a funcao sendFile assim quando for enviar o arquivo so digitar o nome dele dentro da pasta views/
	$router->used('views', 'views/');

	// Rota Padrão Metodo GET
	$router->get("/", function($req, $res) use($container){
		$res->sendFile("home.html");
		$res->send('<video src="./filme/cerca.mp4" controls autoplay></video>');
		print_r($container->get("meu_database"));
	});

	/*// STREAM FILE
	$router->params("/stream/{name}", function($req, $res){
		$res->send("Stream File!!");
		print_r($req->params("name"));
		//print_r(Stream\StreamServer::CreateStream());
	});*/

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
		$res->send($req->params('meu')." ".$req->params('nome')."<br/>");
		// Invoca uma classe externa
		// [ O AUTOLOAD FUNCIONA src/NomeDaClass/NomeDaClass.php ] //
		$hello = new Hello\Hello();
	});

	$router->params("/filme/{nome}", function($req, $res){
		$fileName = "assets/video/".$req->params('nome');
		Stream\StreamServer::CreateStream($fileName);
	});

	$router->Run();