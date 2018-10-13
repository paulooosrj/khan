<?php

/**
 *  --------------------------
 * | Register The Auto Loader |
 *	--------------------------
 */
require __DIR__ . '/../vendor/autoload.php';
/**
 * ------------------------------------------------
 * Khan - PHP Framework
 *
 * @package  Khan
 * @author   PaulaoDev <jskhanframework@gmail.com>
 * ------------------------------------------------
 */

App\Khan\KhanFactory::create()
	->set('KHAN_INIT', microtime(true))
	->set('ROOT_FOLDER', str_replace(DIRECTORY_SEPARATOR . 'public', '', __DIR__))
	->dispatch();