<?php
	
	$router::params('/perfil/{id}', function($req, $res){
		echo "Perfil id {$req->params('id')}";
	});

	$router::get('/teste', 'MyApp\TesteController::index');
