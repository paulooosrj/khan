<?php

	namespace MyApp;
	use \StrategysAuth\Strategy as Strategy;

	class MundoController extends \App\Khan\Bootstrap\KhanController {

		public function index($req, $res, $db){
			$this->container::bind('msg', 'Ola mundo!!');
			return $this->container::get('msg');
		}

		public function getDB(){
			return $this->db();
		}

	}
