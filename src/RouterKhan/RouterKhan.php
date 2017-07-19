<?php
	
	namespace RouterKhan;
	use RouterKhan\RouterKhanReq as RouterKhanReq;
	use RouterKhan\RouterKhanRes as RouterKhanRes;
	session_start();
	/**
	*  Classe De Rotas [ POST & GET & PARAMETER]
	*/

	class RouterKhan{
		
		private static $instance = null;
		public static $_DELETE;
		public static $_PUT;
		private static $routess = array(
			"get" => array(),
			"post" => array(),
			"params" => array(),
			"delete" => array(),
			"put" => array(),
			"patch" => array()
		);
		private static $routessUse = [];
		private static $routesParameter = array();

		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new RouterKhan();
			}
			return self::$instance;
		}

		protected function __construct(){
			if (strtolower($_SERVER['REQUEST_METHOD']) == 'delete') {
    				parse_str(file_get_contents('php://input'), self::$_DELETE);
			}
			if (strtolower($_SERVER['REQUEST_METHOD']) == 'put') {
    				parse_str(file_get_contents('php://input'), self::$_PUT);
			}
		}

		public function filterRequests(){
			$_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
			$_GET = filter_input_array(INPUT_GET, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
		}

		public function used($n, $v){
			self::$routessUse[$n] = $v;
		}

		public function get($name, $callback){
			self::$routess["get"][$name] = $callback;
		}

		public function post($name, $callback){
			self::$routess["post"][$name] = $callback;
		}

		public function put($name, $callback){
			self::$routess["put"][$name] = $callback;
		}

		public function delete($name, $callback){
			self::$routess["delete"][$name] = $callback;
		}

		public function params($name, $callback){
			self::$routess["params"][$name] = $callback;
		}

		public function isParameter($url){
			$routes = self::$routess["params"];
			$routerActive = false;
			foreach($routes as $rota => $fn){ if(preg_match('/[{}]/', $rota)): $routerActive = $rota; endif; }
			if($routerActive){
			     $lengRoute = explode("/", substr($routerActive, 1));
			     $lengUri = explode("/", substr($url, 1));
			     if(count($lengUri) == count($lengRoute) && $lengRoute[0] == $lengUri[0]){
					unset($lengRoute[0], $lengUri[0]);
					$rr = array(); 
					foreach($lengRoute as $key => $r){ $rr[str_replace(['{','}'], '', $r)] = $lengUri[$key]; }
					self::$routesParameter[$routerActive] = $rr;
					return $routerActive;
			     }
			}
			return false;
		}

		public function Run(){
			// Limpas As Requisiçoes
			$this->filterRequests();
			// Pega Url Amigavel do navegador
			$uri = (empty($_GET["url"])) ? "/" : "/".$_GET["url"];
			// Filtra URL
			$uri = strip_tags(addslashes($uri));
			// Pega metodo da requisiçao
			$method = strtolower($_SERVER["REQUEST_METHOD"]);
			// Verifica se é rota com parametro
			$isParams = $this->isParameter($uri);
			// Informa metodo como param
			if(strlen($isParams) > 0 && $isParams != false){ $method = "param"; }
			if($method == "get" && isset(self::$routess["get"][$uri])){
					// Verifica se é rota GET
					$fn = self::$routess["get"][$uri];
					$dataReceive = array(
						"get" => $_GET,
						"session" => $_SESSION
					);
					$fn(
						$req = new RouterKhanReq($dataReceive),
						$res = new RouterKhanRes(self::$routessUse)
					);
			} elseif($method == "post" && isset(self::$routess["post"][$uri])){ 
				    // Verifica se é rota POST
					$fn = self::$routess["post"][$uri];
					$dataReceive = array(
						"get" => $_GET, 
						"post" => $_POST,
						"session" => $_SESSION
					);
					$fn(
						$req = new RouterKhanReq($dataReceive),
						$res = new RouterKhanRes(self::$routessUse)
					);
			} elseif($method == "delete" && isset(self::$routess["delete"][$uri])){
					// Verifica metodo DELETE 
					$fn = self::$routess["delete"][$uri];
					$dataReceive = array(
						"delete" => self::$_DELETE,
						"session" => $_SESSION
					);
					$fn(
						$req = new RouterKhanReq($dataReceive),
						$res = new RouterKhanRes(self::$routessUse)
					);
			} elseif($method == "put" && isset(self::$routess["put"][$uri])){ 
					// Verifica metodo PUT
					$fn = self::$routess["put"][$uri];
					$dataReceive = array(
						"put" => self::$_PUT,
						"session" => $_SESSION
					);
					$fn(
						$req = new RouterKhanReq($dataReceive),
						$res = new RouterKhanRes(self::$routessUse)
					);
			} elseif($method == "param" && count(self::$routesParameter) > 0){ 
				// Verifica se é rota com parametro
				$fn = self::$routess["params"][$isParams];
				$paramReceive = end(self::$routesParameter);
				$dataReceive = array(
					"post" => $_POST,
					"get" => $_GET,
					"params" => $paramReceive,
					"session" => $_SESSION
				);
				$fn(
					$req = new RouterKhanReq($dataReceive),
					$res = new RouterKhanRes(self::$routessUse)
				);
			} else{  
				// Rota Caso não Exista ROTA
				echo '<style>*{margin:0;padding:0}.error{height:100vh;width:100%;display:flex;justify-content:center;align-items:center;font-family:"Helvetica Neue",sans-serif !important;font-size:32px}red{color:red}</style><div class="error"><red>Error 404</red> : Rota "'.$uri.'" Não Definida!!</div>';
				http_response_code(404);
			}
		}
	}
