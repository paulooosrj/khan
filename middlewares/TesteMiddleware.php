<?php

	namespace Middlewares;

	class TesteMiddleware implements \App\Khan\Contracts\Middlewares\Middleware {

		public static function handle($req, $res, \Closure $next){

			echo "TesteMiddleware!!<br/>";

			$next($req, $res);

		}

	}
