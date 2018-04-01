<?php
	
	$container::bind("teste", function(){
		return "Comece o desenvolvimento!!";
	});

	$router::get('/', function($req, $res){

		$res->render('index.html', [
			'message' => $this->container->get('teste')()
		]);
		
	});
