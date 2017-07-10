<?php

	/**
	* Request e Response
	*/

	class Req{

		public function get(){
			return $_GET;
		}

		public function post(){
			return $_POST;
		}

	}