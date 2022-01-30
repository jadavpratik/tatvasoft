<?php

namespace core;
	
class Response{

	public function render($view, $arr=false){
		if(!empty($arr))
			extract($arr);
		$view_path = ROOT.'/app/views/'.$view.'.php';
		require_once $view_path;
	}

	public function json($data){
		echo "<pre>";
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	public function redirect($path){
		echo 'Redirect';
	}

}