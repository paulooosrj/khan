<?php

	function redirect($url){

		header("Location: {$url}");

	}

	function view($url){

		return 'resources/views/' . $url;

	}

	function assets($url){

		return $_ENV['APP_URL']. "/" . "assets" . $url;

	}
