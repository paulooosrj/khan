<?php

	$container::bind("teste", function(){
		return "Testando Aplicação";
	});

	$router::get('/', function($req, $res){
		$res->view('index.html', [
			'message' => $this->container->get('teste')()
		]);
	});
