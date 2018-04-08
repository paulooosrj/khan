<?php

	Router::get('/libs', function($req, $res){

		$this->helpers('files', 'session');

		print_r($this->files);
		echo "<br/>";
		print_r($this->session);

	});

	Router::get('/redi', function($req, $res){

		Router::redirect('/perfil/150');

	});
