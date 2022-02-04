<?php

namespace core;
	
class Request{

	public $params = [];
	public $body = [];
	public $files = [];

	public function __construct($arr=false){

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

		if(!empty($_POST)){
			$this->body = (object) $_POST;
		}

		if(!empty($_FILES)){
			$this->files = (object) $_FILES;
		}

	}



}