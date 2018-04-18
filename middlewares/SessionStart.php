<?php

	namespace Middlewares\Middlewares;

	class SessionStart implements \App\Khan\Contracts\Middlewares\Middleware {

		public static function handle($req, $res, $next){

			$req->name2d = "Ola mundo!!";
			$next($req, $res);

		}

	}
