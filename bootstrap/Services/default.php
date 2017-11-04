<?php

	// Usando Medoo namespace
	use Medoo\Medoo;

	// Initialize
	$database = new Medoo([
		'database_type' => 'mysql',
		'database_name' => 'router_login',
		'server' => 'localhost',
		'username' => 'root',
		'password' => ''
	]);

	$container::bind("views", function(){ 
		return "templates/views/"; 
	});

	$container::bind("url", function(){ 
		return "http://localhost/RouterKhan"; 
	});

	$container->db = function() use($database){
		return $database;
	};

	$container->view = function(){
		$loader = new Twig_Loader_Filesystem('templates/views/');
		$twig = new Twig_Environment($loader, array(
		    'cache' => '/resoures/cache/',
		   	'auto_reload' => true
		));
		return $twig;
	};

	$container->isLogged = function(){
		return "MyApp\Models\isLoggedModel";
	};

	$container->Session = function(){
		return "MyApp\Models\Session";
	};

	$path = $container->get('url')();
	$container->app = function() use($path){
		return new class($path) {
			public function __construct($path = ''){ 
				$this->base = $path;
				return $this; 
			}
			public function css($default = "/public/assets/css"){
				return $this->base.$default;
			}
			public function js($default = "/public/assets/js"){
				return $this->base.$default;
			}
			public function __invoke(){
				return $this->base;
			}
		};
	};