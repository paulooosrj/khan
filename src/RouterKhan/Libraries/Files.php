<?php

	namespace App\RouterKhan\Libraries;

	class Files {

		public function __construct(){
			return $this;
		}

		public function isType(array $file,string $type){
			return $file["type"] === "image/".$type;
		}

		public function sizeMax($size, $file){
			return ($size * 1000000) > $file["size"];
		}

		public function exists($dir, $file, $encrypt = false){
			$name = $file["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			if($encrypt){ $name = md5($name).".".$ext; }
			$filename = $dir.'/'.$name;
			return file_exists($filename);
		}

		public function move($file, $dir, $encrypt = false){
			$name = $file["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$temp = $file["tmp_name"];
			if($encrypt){ $name = md5($name).".".$ext; }
			$filename = $dir.'/'.$name;
			if(move_uploaded_file($temp, $filename)){
				return $filename;
			}
			return false;
		}

	}
