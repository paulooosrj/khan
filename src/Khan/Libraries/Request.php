<?php

    namespace App\Khan\Libraries;

    class Request {

    	public function __construct(){
            return $this;
        }

        public function post($url = null, $data = []){
        	if(is_null($url)){ return false; }
        	$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$result = curl_exec($ch);
			if(curl_errno($ch)){
				echo 'Curl error: '. curl_error($ch);
			}
			curl_close($ch);
			return $result;
        }

        public function get($url = null){
        	if(is_null($url)){ return false; }
        	return file_get_contents($url);
        }

    }
