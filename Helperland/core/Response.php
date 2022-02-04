<?php

namespace core;
	
class Response{

	public function render($view, $arr=false){
		if(!empty($arr))
			extract($arr);
		$view_path = ROOT.'/app/views/'.$view.'.php';
		require_once $view_path;
	}
	public function status($status_code){
		// 200 : OK
		// 201 : CREATED
		// 400 : BAD REQUEST
		// 409 : CONFLICT		
		// 500 : INTERNAL SERVER
		http_response_code($status_code);
		return $this;
	}

	public function json($data){
		// header('Content-Type: application/json');
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	public function redirect($path){
		header("location:");
	}

}