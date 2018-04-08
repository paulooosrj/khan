<?php
	
	Router::params('/perfil/{id}', function($req, $res){
		echo "Perfil id {$req->params('id')}";
	});

	Router::get('/teste', 'MyApp\TesteController::index');
