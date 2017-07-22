<?php 

	namespace Dom;

	class DataMining{

		private static $status = "parado";
		private static $mining = [];
    private static $file = [];

		public function __construct(){
			$pessoa = end($this->fbSearch($this->genPessoa()));
			$mining = $this->GetInfos($this->getUserFB($pessoa));
			if(count($mining) > 0){
				self::$status = "minando";
				self::$mining = $mining;
			}else{
				self::$status = "erro";
			}
			return $this;
		}

		function GetInfos($dom){

  			if(preg_match("/html/s", $dom)){
          		/*$doc = new \DOMDocument();
          		libxml_use_internal_errors(true);
          		$doc->loadHTML($dom);
          		libxml_clear_errors();
          		$finder = new DomXPath($doc);*/
          		$manipulate = new Manipulate($dom);
  				    //file_put_contents('debug.txt', $dom);
          		// PEGA NOME
          		$nome = $this->trata($manipulate->find("div")->querySelector("#fb-timeline-cover-name")->nodeValue);
          		// PEGA IMAGEM
          		if($manipulate->find("img")->querySelector(".profilePic img")){
          			$imagem = $manipulate->find("img")->querySelector(".profilePic img")->getAttribute('src');
          		}
  				    // PEGA LINK DO PERFIL
          		$url_profile = $manipulate->find("a")->querySelector("._2nlw")->getAttribute("href");
          		// CONTAINER DE INFOS
          		$sobre = [];
          		if($manipulate->find("span")->querySelector("._50f5 _50f7")){
            		$sobre["cidade"] = $this->trata($manipulate->find("span")->querySelector("._50f5 _50f7")->nodeValue);
          		}

          		foreach ($manipulate->finder->query("//tbody") as $key => $o) {
              		//$sobre[$o->textContent] = ''; 
              		$vs = [];
              		$ks = [];
              		foreach ($manipulate->finder->query("//div[@class='mediaPageName']", $o) as $key => $value) {
              			$vs[$key] = $this->trata($value->nodeValue);
              		}
              		foreach($manipulate->finder->query("//div[@class='labelContainer']", $o) as $k => $n){
                		$ks[$k] = $this->trata($n->nodeValue);
              		}
              		foreach ($vs as $key => $os) {
              			if(isset($ks[$key])){
              				$sobre[$ks[$key]] = $os;
              			}
              		}
          		}
          		//echo $dom;
  				return [
            		// PEGA O NOME DA PESSOA
  					"nome" => $nome,
            		// PEGA IMAGEM DE PERFIL
            		"imagem" => $imagem,
            		"url_profile" => $url_profile,
            		"sobre" => $sobre
  				];
  			}

  		}

		public function getUserFB($link){
    		// Create a stream
			  $opts = [
    			"http" => [
        			"method" => "GET",
        			"user_agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36"
    			]
			  ];

			  $context = stream_context_create($opts);
			  
        try {
          self::$file = file_get_contents($link, false, $context);
        } catch (Exception $e) {
          die("Error : ".$e->getMessage());
        }

    		return self::$file;

  		}

		public function genPessoa(){ 
      		$file_contents = file_get_contents("http://www.wjr.eti.br/nameGenerator/index.php?q=1&o=json");
      		return $this->trata(json_decode($file_contents)[0]); 
  		}

    public function trata($string){
        return utf8_encode($this->tirarAcentos($string));
    }

		public function tirarAcentos($string){
    		return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
		}

		public function fbSearch($name){

			$name = (string) urlencode(utf8_encode($name));
        	$fbApi = "https://www.google.com.br/search?sclient=psy-ab&biw=1366&bih=662&noj=1&q=pt-br.facebook.com/people/{$name}&oq=pt-br.facebook.com/people/{$name}";
        	$file_contents = file_get_contents($fbApi);
        	$result = "";
        	if(strlen($file_contents) > 0){
        		if(preg_match("/<div class=\"g\">(.*?)<\/div>/s", $file_contents)){
        			preg_match_all('/<div class=\"g\">(.*?)<\/div>/s', $file_contents, $resultados);
        			$resultados = $resultados[0];
        			if(count($resultados) > 0){
        				preg_match_all('/<a href=\"(.*?)\">/s', $file_contents, $result);
        				$result = $result[1];
        				foreach ($result as $key => $resultado) {
        					if(preg_match("/pt-br.facebook.com/", $resultado) && preg_match("/url/", $resultado) && preg_match("/people/", $resultado)){
        						$resultado = str_replace("/url?q=", "", $resultado);
        						$resultado = preg_replace("/&(.*)/", "", $resultado);
        						$result[$key] = utf8_encode(htmlspecialchars_decode($resultado));
        					}else{
        						unset($result[$key]);
        					}
        				}
        			}else{
        				die("Nenhum resultado retornado!!");
        			}
        		}else{
        			die("Nenhum resultado retornado!!");
        		}
        	}else{
          		die("Erro ao pesquisar!!");
        	}
        	return $result;

		}

		public static function Status(){
			return self::$status;
		}

		public function Work(){
			if(count(self::$mining) > 0){
				self::$status = "minando";
				return self::$mining;
			}else{
				die("Error DataMining: ".self::$status);
			}
		}

	}