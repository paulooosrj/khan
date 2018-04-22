<?php
	
	Router::group('/painel', function($route){

		$route->map('GET', '/strategy', function($req, $res){
			print_r(Strategy::make('painel')::login([
				"email" => "admin@admin.com",
				"password" => "paulao2018"
			]));
			/*
			Logout to strategy
			Strategy::make('painel')::logout();
			
			Register to strategy
			Strategy::make('painel')::register([
				"email" => "admin@admin.com",
				"password" => "paulao2018",
				"name" => "PaulaoDev"
			]);
			
			Login to strategy
			Strategy::make('painel')::login([
				"email" => "admin@admin.com",
				"password" => "paulao2018"
			]);

			*/

		});


	}, [ /*Middlewares\InitMiddleware::class*/ ]); 
