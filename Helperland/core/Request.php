<?php

namespace core;

class Request{

	public $params;
	public $body;
	public $files;

	public function __construct($params=false){

		$this->params = array();
		$this->body   = array();
		$this->files  = array();		

		$headers = apache_request_headers();
		$contentType = isset($headers['Content-Type'])? $headers['Content-Type'] : '';

		if(!empty($params)){
			$this->setParams($params);
		}

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

	// SET PARAMS [URL PARAMETERS]...
	public function setParams($params){
		[$key, $value] = $params;
		if(count($key)==count($value)){
			// PARAMS KEY IS FIXED SO LOOP IS RUNNING ACCORDING TO THAT...
			for($i=1; $i<count($key); $i++){
				if(str_contains($key[$i], ':')){
					$param_key = ltrim($key[$i],':');
					$param_value = $value[$i];
					$this->params[$param_key] = $param_value;
				}
			}
			$this->params = (object) $this->params;
		}
	}

	// SET JSON...
	public function setJSON(){
		if(file_get_contents('php://input')){
			// php://input (ONLY FOR INCOMING JSON DATA...)
			$php_input = file_get_contents('php://input');
			// [json_decode($arr,false) return object]
			// [json_decode($arr,true) return array]
			$this->body = json_decode($php_input, false);
		}	
	}

	// SET POST...
	public function setPOST(){
		if(!empty($_POST)){
			$this->body = (object) $_POST;
		}
	}

	// SET FILES & POST...
	public function setFILES(){
		if(!empty($_POST)){
			$this->body = (object) $_POST;
		}
		if(!empty($_FILES)){
			$this->files = (object) $_FILES;
		}
	}

}