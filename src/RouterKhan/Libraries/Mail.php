<?php

	namespace App\RouterKhan\Libraries;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Mail {

		public function __construct(){

			$this->mail = new PHPMailer(true);
			return $this->mail;

		}

	}
