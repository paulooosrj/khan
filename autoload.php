<?php

	function __autoload($class){
		$sep = DIRECTORY_SEPARATOR;
		$folderApp = "Src/";
		$fileName = $folderApp.str_replace('\\', '/', $class).".php";
		if(file_exists($fileName)){
			include_once($fileName);
		}
	}