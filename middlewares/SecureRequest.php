<?php

	namespace Middlewares\Middlewares;

	class SecureRequest implements \App\Khan\Contracts\Middlewares\Middleware {

		public static function handle($req, $res, $next){

			$req->named = "Ola mundo!!";
			$next($req, $res);

		}

	}
