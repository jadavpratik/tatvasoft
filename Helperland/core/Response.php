<?php

namespace core;

class Response{

	public function render($view, $arr=false){
		if(!empty($arr))
			extract($arr);

		$view = ltrim($view, '/');
		$view_path = __DIR__.'/../app/views/'.$view.'.php';

		if(file_exists($view_path)){
			require_once $view_path;
		}

	}

	public function status($status_code){
		// 200 : OK
		// 201 : CREATED
		// 204 : REQUEST ACCEPTED SUCCESSFULLY WITH NO RESPONSE (UPDATE, DELETE) 
		// 401 : WRONG CREDENTIALS
		// 400 : BAD REQUEST
		// 403 : RIGHT CREDENTIALS BUT NOT ALLOWED TO ACCESS RESOURCE...
		// 404 : NOT FOUND
		// 409 : CONFLICT		
		// 500 : INTERNAL SERVER
		// 502 : BAD GATEWAY
		http_response_code($status_code);
		return $this;
	}

	public function json($data){
		// header('Access-Control-Allow-Origin:*');
		// header('Access-Control-Allow-Credentials:true');
		// header('Access-Control-Allow-Methods:GET, POST, PUT, PATCH, DELETE');
		// header('Access-Control-Allow-Headers:*');
		// header('Content-Type:application/json');		
		echo json_encode($data, JSON_PRETTY_PRINT);
		exit();
	}

	public function redirect($path){
		$path = ltrim($path, '/');
		$redirect_path = BASE_URL.'/'.$path;
		header("location:{$redirect_path}");
	}

}