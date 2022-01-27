<?php

namespace core;
	
class Request{

	public $params = [];
	private $body = [];

	public function __construct($arr){
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
	}
}