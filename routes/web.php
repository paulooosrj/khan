<?php
	
	Container::bind("teste", function(){
		return "Comece o desenvolvimento!!";
	});

	Router::get('/', function($req, $res){

		$res->render('index.html', [
			'message' => $this->container->get('teste')()
		]);
		
	});

	Router::get('/teste', "MyApp\TesteController@index");

	Router::get('/teste_middleware', function(){})
			->name('teste_middleware')
			->middleware(Middlewares\TesteMiddleware::class);

	Router::post('/chat-emit', function($req, $res){

		$socket = App\Khan\Component\Socket\Socket::init();
		$socket::emit($req->post('channel'), $req->post('message'));

	}); 
