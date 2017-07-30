<?php

	namespace App\Request;

	class Request{

		public function __construct(){}

		public function error(string $msg){
			throw new Exception($msg, 1);
		}

		public function createContext(array $c){
			$context = [
  				'http' => [
        			'method' => $c["method"]
        		]
        	];
        	if(isset($c['data'])){
        		$context['http']['content'] = (empty($c["data"])) ? "" : $c["data"];
        	}
        	if(isset($c["header"])){ 
        		$context['http']['header'] = (empty($c["header"])) ? "Content-type: application/x-www-form-urlencoded" : $c["header"];
        	}
        	print_r($context);
			return stream_context_create($context);
		}

		public function Get(array $c){
			if(!isset($c["url"])){ $this->error("Erro ao passar URL no metodo GET"); }
			if(!isset($c["header"])){
				$c["header"] = "Content-type: application/x-www-form-urlencoded\r\n";
			}
			if(isset($c["data"]) && is_array($c["data"])){
				$c["data"] = http_build_query($c["data"]);
				return file_get_contents($c["url"].$c["data"], false, $this->createContext([
					"method" => "GET", 
					"header" => $c["header"]
				]));
			}else{
				return file_get_contents($c["url"], false, $this->createContext([
					"method" => "GET", 
					"header" => $c["header"]
				]));
			}
		}
		public function Post(array $c){
			if(!isset($c["url"])){ $this->error("Erro ao passar URL no metodo POST"); }
			if(!isset($c["header"])){
				$c["header"] = "Content-type: application/x-www-form-urlencoded\r\n";
			}
			if(isset($c["data"]) && is_array($c["data"])){
				$c["data"] = http_build_query($c["data"]);
				$con = $this->createContext([
					"method" => "POST",
					"data" => $c["data"], 
					"header" => $c["header"]
				]);
				print_r($c["data"]);
				return file_get_contents($c["url"], false, $con);
			}else{
				return file_get_contents($c["url"], false, $this->createContext([
					"method" => "POST",
					"data" => $c["data"],
					"header" => $c["header"]
				]));
			}
		}

	}