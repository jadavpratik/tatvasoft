<?php

namespace core;

use \stdClass;

class Request{

	public $params;
	public $body;
	public $files;

	public function __construct($arr=false){

		$this->params = new stdClass();
		$this->body = new stdClass();
		$this->files = new stdClass();		

		// SET PARAMS...
		if(!empty($arr)){
			[$key, $value] = $arr;
			if(count($key)==count($value)){
				for($i=1; $i<count($key); $i++){
					if(str_contains($key[$i],':')){
						$param_key = ltrim($key[$i],':');
						$param_value = $value[$i];
						$this->params[$param_key] = $param_value;
					}
				}
				$this->params = (object) $this->params;
			}	
		}

		if(isset($_SERVER['CONTENT_TYPE'])){
			$contentType = $_SERVER['CONTENT_TYPE'];
			// HEADERS FOR TOKEN AUTHENTICATIONS...
			// $headers = apache_request_headers();
			// $contentType = $headers['Content-Type'];
			// $_token = $headers['_token'];
			if(str_contains($contentType, 'application/json')){
				$this->setJSON();
			}
			else if(str_contains($contentType, 'application/x-www-form-urlencoded')){
				$this->setPOST();
			}
			else if(str_contains($contentType, 'multipart/form-data')){
				$this->setFILES();
			}
		}

	}

	public function setJSON(){
		if(file_get_contents('php://input')){
			// php://input (ONLY FOR INCOMING JSON DATA...)
			$php_input = file_get_contents('php://input');
			// [json_decode($arr,false) return object]
			// [json_decode($arr,true) return array]
			$this->body = json_decode($php_input, false);
		}	
	}

	public function setPOST(){
		// SET POST DATA...
		if(!empty($_POST)){
			$this->body = (object) $_POST;
		}
	}
	
	public function setFILES(){
		// SET POST DATA...
		if(!empty($_POST)){
			$this->body = (object) $_POST;
		}
		// SET FILES DATA...
		if(!empty($_FILES)){
			$this->files = (object) $_FILES;
		}	
	}

}