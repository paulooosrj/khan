<?php 


		namespace MyApp\Models;

		class Mail {

			private static $instance = null;

			public static function create(){
				if(self::$instance == null){
					self::$instance = new Mail();
				}
				return self::$instance;
			}

			protected function __construct(){}

			public function type(string $type){
				$this->type_send = $type;
			}

			public function body(Array $code){
				extract($code);
				$this->emit = "
					<!DOCTYPE html>
					<html>
					<head>
						<meta charset='utf-8'>
						<meta http-equiv='X-UA-Compatible' content='IE=edge'>
						<title>{$title}</title>
					</head>
					<body>
						<style>{$style}</style>
						$body
					</body>
					</html>
				";
			}

			public function person(string $email){
				$this->headers ='MIME-Version: 1.0' . "\r\n";
				$this->headers .='From: Your name jskhanframework@gmail.com' . "\r\n";
				$this->headers .='Content-type: text/html; charset=iso-8859-1'."\r\n";
				$this->mail_send = $email;
			}

			public function send(){
				mail($this->mail_send, $this->type_send, $this->emit, $this->headers);
			}

		}