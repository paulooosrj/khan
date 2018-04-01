<?php

	$router::get('/libs', function($req, $res){

		$this->helpers('files', 'session');

		print_r($this->files);
		echo "<br/>";
		print_r($this->session);

	});

	$router::get('/redi', function($req, $res){

		redirect('/perfil/150');

	});
