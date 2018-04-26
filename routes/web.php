<?php
	
	Container::bind("teste", function(){
		return "Comece o desenvolvimento!!";
	});

	Router::notFound(function($req, $res){
		$res->setStatusCode(404);
		return die("Route not found insert in router!!");
	});

	Router::get('/', function($req, $res){
		$message = Container::get('teste')();
		$res->render('index.html', [
			'message' => $message
		]);
	});

	Router::get('/form', function($req, $res){
		return $res->render('csrf.html');
	});

	Router::post('/form', function($req, $res){
		return Router::csrf_token_verify($req->post('token')) 
				? 'verdadeiro': 'falso';
	});

	Router::get('/teste', "MyApp\TesteController@index");

	Router::get('/teste_middleware', 'MyApp\MundoController@index')
			->name('teste_middleware')
			->middleware(Middlewares\TesteMiddleware::class);

	Router::post('/chat-emit', function($req, $res){

		$socket = App\Khan\Component\Socket\Socket::init();
		$socket::emit($req->post('channel'), $req->post('message'));

	}); 
