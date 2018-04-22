<?php
	
	/**
	 * Define alises ( global class ) using in project
	 */
	
	return [
		"Container" => "App\Khan\Component\Container\ServiceContainer::create",
		"Router" => "App\Khan\Component\Router\Router\Router::create",
		"DB" => "App\Khan\Component\DB\DB::getConn",
		"Strategy" => "App\Khan\Component\Strategy\Strategy::create"
	];
