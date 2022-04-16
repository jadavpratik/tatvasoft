<?php

// header('Access-Control-Allow-Origin:*');
// header('Access-Control-Allow-Credentials:true');
// header('Access-Control-Allow-Methods:GET, POST, PUT, PATCH, DELETE');
// header('Access-Control-Allow-Headers:*');
// header('Content-Type:application/json');		

namespace core;
use core\Response;


class Request{

	public $params;
	public $body;
	public $files;

	public function __construct($params=false){

		$this->params = array();
		$this->body   = array();
		$this->files  = array();		

		$headers = getallheaders();
		$contentType = isset($headers['Content-Type'])? $headers['Content-Type'] : '';

		// ----------CHECK-CSRF-TOKEN----------
		// if($_SERVER['REQUEST_METHOD']!='GET'){
		// 	$res = new Response();
		// 	$errors = ['session'=>$_SESSION['CSRF-TOKEN'], 'req_header'=>$headers['CSRF-TOKEN']];
		// 	if(isset($headers['CSRF-TOKEN'])){
		// 		if($headers['CSRF-TOKEN']==$_SESSION['CSRF-TOKEN']){
		// 			csrf_token();
		// 		}
		// 		else{
		// 			$res->status(401)->json(['message'=>'CSRF token is not matched!!!', 'errors'=>$errors]);
		// 		}
		// 	}
		// 	else{
		// 		$res->status(400)->json(['message'=>'CSRF Token is required!!!', 'errors'=>$errors]);
		// 	}		
		// }

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
			// PARAMS-VALUE NOT FIXED [HOW MANY COMES FROM URL]
			// PARAMS-KEY IS FIXED [FIXED KEY COMES FROM ROUTE FUNCTIONS]
			// SO LOOP IS RUNNING ACCORDING TO PARAMS-KEY...
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