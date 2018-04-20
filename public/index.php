<?php

	/**
	 * Khan - PHP Framework For Khan Cli
	 *
	 * @package  Khan
	 * @author   PaulaoDev <jskhanframework@gmail.com>
	 */
	
	define('KHAN_INIT', microtime(true));

	$folder = join(array(DIRECTORY_SEPARATOR, 'public'));

	define('ROOT_FOLDER', str_replace($folder, '', __DIR__ ));

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
	
	$application = App\Khan\KhanFactory::create();
	$application->dispatch();
