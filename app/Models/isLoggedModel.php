<?php 

	namespace MyApp\Models;

	@session_start();

	class isLoggedModel{

		public function __construct($session){
			if(isset($_SESSION[$session]) && !empty($_SESSION[$session])){
				return true;
			}else{
				return false;
			}
		}

	}