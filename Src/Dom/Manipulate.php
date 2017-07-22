<?php

	namespace Dom;

	class Manipulate{

		public function __construct($dom){
			$this->dom = new \DOMDocument();
          	libxml_use_internal_errors(true);
          	$this->dom->loadHTML($dom);
          	libxml_clear_errors();
          	$this->finder = new \DomXpath($this->dom);
		}

		public function find($f){
			$this->find = $f;
			return $this;
		}

		public function querySelector($n){
			if($n{0} == "#"){
				$n = substr($n, 1);
				return $this->dom->getElementById($n);
			} elseif($n{0} == "."){
				$n = substr($n, 1);
				$e = $this->find;
				$search = '';
				foreach ($this->dom->getElementsByTagName($e) as $key => $a) {
             		if (strpos($a->getAttribute("class"), $n) !== false){
               	 		$search = $a;
             		}
          		} 
          		return $search;
			}
		}

	}