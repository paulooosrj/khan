<?php
	
	/**
	 * Middlewares padrão do projeto
	 */

	return [
		Middlewares\SessionStart::class,
		Middlewares\SecureRequest::class
	];
