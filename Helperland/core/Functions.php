<?php

	// FOR START THE SESSION...
	session_start();
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
		return BASE_URL.$path;
	}

	// FOR PUBLIC FOLDER ACCESS...
	function assets($path){
		return BASE_URL.'/'.$path;
	}

	// RETURN COMPONENTS LIKE HEADER, FOOTER, MODELS ETC...
	function component($parameter1, $parameter2=false){
		if($parameter2!=false){
			// WE CAN CHANGE THE COMPONENT PATH IN VIEWS Directory...
			$path = $parameter1;
			$name = $parameter2;
			$component_path = ROOT.'/app/views/'.$path.$name.'.php';
			require_once $component_path;			
		}
		else{
			// BY DEFAULT ALL COMPOENTS LOADED FROM VIEWS/COMPONENTS/...
			$name = $parameter1;
			$component_path = ROOT.'/app/views/components/'.$name.'.php';
			require_once $component_path;
		}
	}

	// SESSION FUNCTIONS...
	function session($key, $value=false){
		if($value!=false){
			// SET SESSION...
			$_SESSION[$key] = $value;
		}
		else if(isset($_SESSION[$key])){
			// GET SESSION...
			return $_SESSION[$key];
		}
		else{
			return false;
		}
	}

