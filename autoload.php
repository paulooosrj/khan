<?php

	function __autoload($class){
		$cDir = ['classes'];
		$iDir = null;
		$sep = DIRECTORY_SEPARATOR;
		foreach($cDir as $dirName):
			$fileName = __DIR__.$sep.$dirName.$sep.$class.".class.php";
			if(!$iDir && file_exists($fileName)):
				include_once($fileName);
				$iDir = true;
			endif;
		endforeach;
	}