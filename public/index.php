<?php

	/**
	 * Khan - PHP Framework For Khan Cli
	 *
	 * @package  Khan
	 * @author   PaulaoDev <jskhanframework@gmail.com>
	 */
	define('KHAN_INIT', microtime(true));
	
	/**
	 * Register The Auto Loader
	 *	------------
	 * Composer provides a convenient, automatically generated class loader for
	 * our application.
	 */
	require __DIR__ . '/../vendor/autoload.php';

	/**
	 * [$application khan core init]
	 * @var [object]
	 */
	
	$application = App\Khan\Khan::create();
	$application->dispatch();
