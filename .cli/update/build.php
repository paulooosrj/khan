<?php
	
	date_default_timezone_set('America/Sao_Paulo');

	class Build {

		public function __construct(){}

		protected function print($text){
			echo "\n   {$text}\n";
		}

		public function request(){
			
			$opts = [
			        'http' => [
			                 'user_agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0.1'
			        ]
			];

			$context = stream_context_create($opts);
			$repo = file_get_contents("https://api.github.com/repos/PaulaoDev/router-khan", false, $context);
			$repo = (array) json_decode($repo);

			if(!file_exists('.cli/update/dates/last.txt')){
				echo $repo["update_at"];
				file_put_contents('.cli/update/dates/last.txt', $repo["updated_at"]);
			}

			return $repo;
		}

		public function checkVersion($repo){

			if(!file_exists('.cli/update/dates/date.txt')){
				file_put_contents('.cli/update/dates/date.txt', $repo["created_at"]);
			}

		}

		public function compare($date1){

			$pushDate = (array) new DateTime($date1);
			$date = '.cli/update/dates/date.txt';
			$originDate = (array) new DateTime(file_get_contents($date));

			if($pushDate['date'] > $originDate['date']){

				$this->print("A uma nova versão mais recente disponivel.");
				$this->print("Aguarde iremos fazer a atualização!!");
				return true;

			}

			return false;

		}

		public function rm($name){
			system("rm -r {$name}");
		}

		public function extractAndMove($zipFile){

			$extractPath = ".cli/update/downloads/cache/";
			$zip = new ZipArchive;

			$res = $zip->open($zipFile);

			if ($res === TRUE) {

				$zip->extractTo($extractPath);
				$zip->close();

				$this->rm('src');

				rename(
					'.cli/update/downloads/cache/router-khan-master/src',
					'src'
				);
				rename(
					'.cli/update/downloads/cache/router-khan-master/khan',
					'khan'
				);
				rename(
					'.cli/update/downloads/cache/router-khan-master/documentation',
					'documentation'
				);

				rename(
					'.cli/update/downloads/cache/router-khan-master/README.md',
					'README.md'
				);

				unlink('.cli/update/downloads/update.zip');
				
				$this->rm('.cli/update/downloads/cache/router-khan-master');

				$date = new DateTime();

				file_put_contents(
					'.cli/update/dates/last.txt', 
					$date->format('Y-m-d')
				);

				$this->print("A atualização foi concluida com sucesso!!");

				return true;

			} else {

			  	$this->print("Erro ao atualizar!!");

			}

		}

		public function downloadZip(){
			$url = "https://github.com/PaulaoDev/router-khan/archive/master.zip";
			$zipFile = ".cli/update/downloads/update.zip";
			$zipResource = fopen($zipFile, "w");
			// Get The Zip File From Server
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_FILE, $zipResource);
			$page = curl_exec($ch);
			if(!$page) {
			 echo "Error :- ".curl_error($ch);
			}
			curl_close($ch);
			return (file_exists($zipFile)) ? $zipFile : false;
		}

		public function check(){

			$repo = $this->request();
			$this->data = $repo["updated_at"];

			file_put_contents('.cli/update/dates/new.txt', $this->data);

			$this->checkVersion($repo);

			if($this->compare($this->data)){

					if($this->extractAndMove($this->downloadZip())){

						file_put_contents('.cli/update/dates/date.txt', file_get_contents('.cli/update/dates/new.txt'));

					}

			}else{

				$this->print("O framework já está atualizado.");

			}

		}

	}
