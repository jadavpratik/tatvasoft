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
		http_response_code(404);
		return $this;
	}

	public function json($data){
		return json_encode($data, JSON_PRETTY_PRINT);
	}

	public function redirect($path){
		header("location:");
	}

}