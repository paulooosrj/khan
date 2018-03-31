<?php

	error_reporting(0);

	require_once 'update/build.php';

	class CliKhan {

		protected static $comando = '';
		protected static $value = '';

		public function __construct($query = null){

			if(is_null($query)){
				$this->helper();
			}

			self::$comando = strpos($query, ':') ? explode(':', $query)[0] : $query;
			self::$value = (strpos($query, ':')) ? end(explode(':', $query)) : false;

			if(method_exists($this, self::$comando)){

				if(!self::$value): $this->{self::$comando}(); endif;
				if(self::$value): $this->{self::$comando}(self::$value); endif;

			}else{

				$this->print(self::$comando . " esta comando não existe.");
				$this->help();

			}

		}

		public function helper(){
			$this->runShell('php khan help');
		}

		protected function runShell($shell, $debug = false){
			if($debug){ shell_exec('cls'); }
			shell_exec( $shell );
		}

		protected function print($text){
			echo "\n\n   {$text}\n\n";
		}

		public function server($porta = 8080){

			$this->print("Servidor ativo em http://localhost:{$porta}");
			$this->runShell("php -S localhost:{$porta} public/index.php");

		}

		public function controller($nameController = null){

			if(is_null($nameController)){

				$this->print("Dê um nome ao controller para criar, exemplo: php khan controller:Teste");
				return false;

			}

			$nameController .= "Controller";

			$controllerDefault = file_get_contents('.cli/controllers/default.php');
			$controllerDefault = str_replace('NameController', $nameController, $controllerDefault);
			$dir = "app/{$nameController}.php";

			if(file_put_contents($dir, $controllerDefault)){
				$this->print("O Controller {$nameController} foi criado com sucesso em: app/{$nameController}.php");
			}

		}

		public function gulp(){

			if(
				copy('.cli/gulp-files/gulpfile.js', 'gulpfile.js') && 
				copy('.cli/gulp-files/package.json', 'package.json')
			){
				$this->print('Aguarde a instalação dos pacotes.');
				$this->runShell('npm i gulp -g && npm install');
			}

		}

		public function update($comando = null){

			if(is_null($comando)){

				$builder = new Build();
				$builder->check();

			}else{
				if($comando === "last"){
					$last = file_get_contents('.cli/update/dates/last.txt');
					$this->print("A ultima atualização ocorreu em {$last}");
				}
			}


		}

		public function help(){

			$this->print("Comandos: \n\n      php khan controller:NomeDoController ( cria um controller ja com a estrutura )\n      php khan server ( liga o servidor php embutido )\n      php khan gulp ( gera estrutura de sass watch e babel loader )");

		}

	}
