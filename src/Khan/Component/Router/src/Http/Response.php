<?php
	
	namespace App\Khan\Component\Router\src\Http;
	use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
  	use \App\Khan\Component\Router\src\Http\Interfaces\Response as ResponseInterface;

	/**
	* Response Class and Interface Implement
	*/

	class Response extends SymfonyResponse implements ResponseInterface{
    
		private static $use = [];
    
		public function __construct($use){
			parent::__construct();
			self::$use = $use;
			
			$folder = (!isset($uses['views'])) ? 'resources/views/' : $uses['views'];
			$loader = new \Twig_Loader_Filesystem($folder);
			$cache = ($_ENV['APP_PRODUCTION'] === 'true') ? ['cache' => $folder . 'compilation_cache'] : [];
			$this->twig = new \Twig_Environment($loader, $cache);
			//$this->render = $this->twig->render;
			foreach(self::$use as $key => $value){
				$this->$key = $value;
			}
		}

		public function view($name){
			return 'resources/views/' . $name;
		}

		public function assets($name){
			return $_ENV['APP_URL'] . "/" . "assets/" . $name;
		}
		
		public function render($file, $data = []){
			// print_r($this->twig->render);
			echo $this->twig->render($file, $data);
		}/**/
		
		public function send($string = ''){
			echo $string;
		}
    
	}
