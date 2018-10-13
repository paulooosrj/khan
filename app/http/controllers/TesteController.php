<?php

namespace Controllers;

class TesteController extends \App\Khan\Bootstrap\KhanController {

	public function index($req, $res) {

		// $this->helpers('cache');

		// $this->cache->init();
		// if(!$this->cache->get('data', $out)){
		// 	$this->cache->set('data', [
		// 		"msg" => $this->container::get('teste')()
		// 	], 300);
		// }

		// $this->cache->get('data', $out);
		// $res->send($out['msg']);

		// $res->send("Ola mundo!!");

		return "Ola mundo!!";

	}

	public function container() {

		return $this->container::get('teste')();

	}

}
