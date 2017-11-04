<?php

		namespace App\RouterKhan\Component\Ml;
		use Phpml\Classification\KNearestNeighbors as KNearestNeighbors;

		class Ml extends KNearestNeighbors{

			private static $instance = null;

			public static function create(){
				if(self::$instance === null){
					self::$instance = new Ml();	
				}
				return self::$instance;
			}

			public function __construct(){
				parent::__construct();
			}

			public function simility(Array $data, String $emit,String $default) : array {
				$callback = ["levels" => []];
				$max = strlen($emit);
				foreach ($data as $key => $entry) {
					$nivel = similar_text($emit, $entry);
					$finish = intval(($nivel / $max) * 100);
					$callback["entrys"][] = [
						"level" => $finish,
						"message" => $entry,
						"receive" => $emit,
						"index" => $key
					];
					$callback["levels"][] = $finish;
				}
				$level_finish = max(array_values($callback["levels"]));
				$callback["finish"] = array_filter($callback["entrys"], function($e) use($level_finish){
					return $e["level"] == $level_finish && $level_finish > 50;
				});
				if(count(array_values($callback["finish"])) > 0){
					$callback["finish"] = end($callback["finish"]);
				}else{
					$callback["finish"] = [
						"level" => 100,
						"message" => $default,
						"receive" => $emit,
						"index" => "default"
					];
				}
				return $callback;
			}

		}