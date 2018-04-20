<?php

	namespace Middlewares;

	class SecureRequest implements \App\Khan\Contracts\Middlewares\Middleware {

		public static function handle($req, $res, $next){

			foreach ($req->getAll() as $key => $valor) {
				if(is_array($valor) && count($valor) > 0){
					foreach ($valor as $k => $value) {
						$filter = addslashes(strip_tags(filter_var($value, FILTER_SANITIZE_STRING)));
						$req->make($key, $k, $filter);
					}
				}
			}

			$next($req, $res);

		}

	}
