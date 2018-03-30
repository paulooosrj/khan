<?php

	require __DIR__.'/vendor/autoload.php';

	$application = App\RouterKhan\Khan::create();
	$application->dispatch();
