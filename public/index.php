<?php

	require __DIR__ . '/../vendor/autoload.php';

	$application = App\Khan\Khan::create();
	$application->dispatch();
