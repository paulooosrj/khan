<?php
	
	$container::bind("teste", function(){
		return "Comece o desenvolvimento!!";
	});

	$router::get('/', function($req, $res){

		$res->view('index.html', [
			'message' => $this->container->get('teste')()
		]);
		
	});
