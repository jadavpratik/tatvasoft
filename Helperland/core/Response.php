<?php

namespace core;
	
class Response{

	public function render($view){
		$view_path = ROOT.'/app/views/'.$view.'.php';
		require_once $view_path;
	}

}