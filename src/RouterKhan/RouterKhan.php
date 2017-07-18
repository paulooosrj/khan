<?php
	
	/**
	*  Classe De Rotas [ POST & GET & PARAMETER]
	*/
	class RouterKhan{
		
		private static $instance = null;
		private static $routess = array("get" => array(),"post" => array(),"params"=>array());
		private static $routessUse = [];
		private static $routesParameter = array();

		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new \RouterKhan();
			}
			return self::$instance;
		}

		protected function __construct(){}

		public function used($n, $v){
			self::$routessUse[$n] = $v;
		}

		public function get($name, $callback){
			self::$routess["get"][$name] = $callback;
		}

		public function post($name, $callback){
			self::$routess["post"][$name] = $callback;
		}

		public function params($name, $callback){
			self::$routess["params"][$name] = $callback;
		}

		public function isParameter($url){
			$myArr = self::$routess["params"];
			$fns = array_filter(array_keys($myArr), function($route){
				return strrpos($route, ":") == true;
			});
			if(count($fns) == 1){
				$fn = end($fns);
				$urlEx = explode('/', $url);
				$fnEx = explode('/', $fn);
				unset($urlEx[0]);
				unset($fnEx[0]);
				if($fnEx[1] == $urlEx[1] && count($urlEx) == count($fnEx)){
					unset($fnEx[1]);
					unset($urlEx[1]);
					$params = $fnEx;
					$values = $urlEx;
					$parametersValue = array();
					$parameters = array_map(function($index) use($values, $params, $parametersValue){
						$rep = str_replace(':','', $params[$index]);
						$parametersValue[$rep] = $values[$index];
						return $parametersValue;
					}, array_keys($params));
					foreach ($parameters as $key => $value) {
						foreach($value as $k => $v){
							$parametersValue[$k] = $v;
						}
					}
					if(count($parametersValue) > 0){
						self::$routesParameter[$fn] = $parametersValue;
						return $fn;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function Run(){
			// Pega Url Amigavel do navegador
			$getUrl = (empty($_GET["url"])) ? "/" : "/".$_GET["url"];
			// Verifica se existe o Post
			$routePost = (!empty($_POST)) ? true : false;
			// Verifica se é rota com parametro
			$isParams = $this->isParameter($getUrl);
			// Verifica se é rota GET
			if(isset(self::$routess["get"][$getUrl]) && $routePost == false){
				$fn = self::$routess["get"][$getUrl];
				$fn($req = new RouterKhanReq(),$res = new RouterKhanRes(self::$routessUse));
			} 
			// Verifica se é rota com parametro
			elseif($isParams&& $routePost == false && count(self::$routesParameter) > 0){
				$fn = self::$routess["params"][$isParams];
				$fn($req = new RouterKhanReq(array("params"=>end(self::$routesParameter))),$res = new RouterKhanRes(self::$routessUse));
			}
			// Verifica se é rota POST
			elseif(isset(self::$routess["post"][$getUrl]) && $routePost == true){
				$fn = self::$routess["post"][$getUrl];
				$dataReceive = array("get" => $_GET, "post" => $_POST);
				$fn($req = new RouterKhanReq($dataReceive),$res = new RouterKhanRes(self::$routessUse));
			}
			else{
				echo '<style>*{margin:0;padding:0}.error{height:100vh;width:100%;display:flex;justify-content:center;align-items:center;font-family:"Helvetica Neue",sans-serif !important;font-size:32px}red{color:red}</style><div class="error"><red>Error 404</red> : Rota "'.$getUrl.'" Não Definida!!</div>';
				http_response_code(404);
			}
		}

	}