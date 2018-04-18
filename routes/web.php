<?php
	
	Container::bind("teste", function(){
		return "Comece o desenvolvimento!!";
	});

	Router::set('twig.testeAmigao', function($msg){
		return "Enginer {$msg}";
	});

	Router::get('/', function($req, $res){

		$res->render('index.html', [
			'message' => $this->container->get('teste')()
		]);
		
	});

	Router::post('/chat-emit', function($req, $res){

		$socket = App\Khan\Component\Socket\Socket::init();
		$socket::emit($req->post('channel'), $req->post('message'));

	}); 
