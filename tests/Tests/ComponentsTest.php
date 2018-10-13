<?php

namespace Tests;

class ComponentsTest extends \PHPUnit\Framework\TestCase {

	public function testReturnTrue() {
		$this->assertTrue(true);
	}

	public function testControllers() {

		$ctrl = new \Controllers\TesteController();
		$this->assertEquals("Ola mundo!!", $ctrl->index([], []));

	}

	public function testEnv() {

		$dotenv = new \Dotenv\Dotenv('../../');
		$dotenv->load();
		$this->assertTrue(!empty($_ENV));

	}

	public function testCrypt() {

		$encrypt = \App\Khan\Component\Encrypt\Encrypt::encrypt(
			'Khan Framework'
		);

		$this->assertTrue(\App\Khan\Component\Encrypt\Encrypt::verify(
			'Khan Framework', $encrypt
		));

	}

	public function testCdn() {

		$cdn = \App\Khan\Component\Cdn\Cdn::create();
		$bootstrap = $cdn->asset(
			'twitter-bootstrap',
			'css/bootstrap.min.css',
			'4.1.3'
		);

		$this->assertEquals(
			"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css",
			$bootstrap
		);

	}

	public function testMime() {

		$img = \App\Khan\Component\Mime\Mime::get('myImage.png');

		$this->assertEquals(
			"image/png",
			$img
		);

	}

}