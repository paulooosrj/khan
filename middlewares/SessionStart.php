<?php

	namespace Middlewares;

	class SessionStart implements \App\Khan\Contracts\Middlewares\Middleware {

		public static function handle($req, $res, $next){

			ini_set('session.use_cookies', 1);
			ini_set('session.use_only_cookies', 0);
			ini_set('session.use_trans_sid', 0);
			ini_set('session.use_strict_mode', 0);
			ini_set('session.cookie_httponly', 1);

			@session_start();

			$next($req, $res);

		}

	}
