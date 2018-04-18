<?php
	
	/**
	 * Middlewares padrão do projeto
	 */

	return [
		Middlewares\Middlewares\SessionStart::class,
		Middlewares\Middlewares\SecureRequest::class
	];
