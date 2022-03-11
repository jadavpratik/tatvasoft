<?php

	$page_url = '/';

	// RETURN & STORE CURRENT URL...
	function page_url($url=false){
		global $page_url;
		if($url!=false){
			$page_url = $url;
		}
		else{
			return $page_url;
		}
	}

	// FOR ANCHOR TAG...
	function url($path){
		$path = ltrim($path, '/');
		$path = rtrim($path, '/');
		return BASE_URL.'/'.$path;
	}

	// FOR PUBLIC FOLDER ACCESS...
	function assets($path){
		$path = ltrim($path, '/');
		return BASE_URL.'/'.$path.'?'.time();
		//APPEND TIME END OF FILE, BECAUSE FILE NOT REFLECTING AFTER CHANGING IT
	}

	// RETURN COMPONENTS LIKE HEADER, FOOTER, MODELS ETC...
	function component($parameter1, $parameter2=false){

		if($parameter2!=false){
			// WE CAN CHANGE THE COMPONENT PATH IN VIEWS Directory...
			$path = $parameter1;
			$name = $parameter2;
			$path = ltrim($path, '/');
			$path = rtrim($path, '/');
			$name = ltrim($name, '/');
			$name = rtrim($name, '/');
			$component_path = __DIR__.'/../app/views/'.$path.'/'.$name.'.php';
			if(file_exists($component_path)){
				require_once $component_path;							
			}
		}
		else{
			// BY DEFAULT ALL COMPOENTS LOADED FROM VIEWS/COMPONENTS/...
			$name = $parameter1;
			$name = ltrim($name, '/');
			$name = rtrim($name, '/');
			$component_path = __DIR__.'/../app/views/components/'.$name.'.php';
			if(file_exists($component_path)){
				require_once $component_path;							
			}
		}
	}

	// SESSION FUNCTION...
	function session($key, $value=false){
		if($value!=false){
			$_SESSION[$key] = $value;
		}
		else if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}
		else{
			return false;
		}
	}

	// COOKIE FUNCTION...
	function cookie($key, $value=false, $time=false){
		if($value!=false){
			// 5 DAYS TIME...
			if($tile==flase){
				$time = time()+(60*60*24*5);
			}
			setcookie($key, $value, $time, '/', '', true, true);
		}
		else if(isset($_COOKIE[$key])){
			return $_COOKIE[$key];
		}
		else{
			return false;
		}
	}