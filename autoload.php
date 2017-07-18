<?php

	function __autoload($class){
		$cDir = ['src'];
		$iDir = null;
		$sep = DIRECTORY_SEPARATOR;
		$vendorApp = "RouterKhan";
		$vendorLoad = false;

		if(strlen($class) >= 10){
			if(substr($class, 0, 10) == $vendorApp && $class != $vendorApp){
				$vendorLoad = true;
			}
		}

		foreach($cDir as $dirName):
			$fileName = __DIR__.$sep.$dirName.$sep.$class.$sep.$class.".php";
			if(!$iDir && file_exists($fileName) && $vendorLoad == false){
				//echo "Upado Via Autoload : ".$fileName."<br>";
				include_once($fileName);
				$iDir = true;
			} elseif($vendorLoad == true && !file_exists($fileName)){
				$fileName = __DIR__.$sep.$dirName.$sep.$vendorApp.$sep.$class.".php";
				if(!$iDir && file_exists($fileName)){
					//echo "Upado Via ".$vendorApp." : ".$fileName."<br>";
					include_once($fileName);
					$iDir = true;
				}
			}
		endforeach;

	}