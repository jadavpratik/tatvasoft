<?php

	// FOR START THE SESSION...
	session_start();

	$title = 'Index';
	$page_url = '/';

	// FOR PUBLIC FOLDER ACCESS...
	function assets($path){
		return BASE_URL.'/'.$path;
	}

	// FOR ANCHOR TAG...
	function url($path){
		return BASE_URL.$path;
	}

	// FOR STORING WHICH URL WE HIT...
	function set_page_url($url){
		global $page_url;
		$page_url = $url;
	}

	// RETURN CURRENT URL...
	function page_url(){
		global $page_url;
		return $page_url;
	}

	// RETURN CURRENT PAGE_TITLE...
	function title(){
		global $title, $page_url;
		switch($page_url){
			case '/' :
				$title = 'Home'; 
				break;
			case '/faqs' :
				$title = 'FAQs'; 
				break;
			case '/prices' :
				$title = 'Prices'; 
				break;
			case '/contact' :
				$title = 'Contact'; 
				break;
			case '/service-provider/signup' :
				$title = 'Service Provider Signup'; 
				break;
			case '/customer/signup' :
				$title = 'Customer Signup'; 
				break;
			case '/book-now' :
				$title = 'Book Now'; 
				break;
		}
		echo $title;
	}

	// RETURN COMPONENTS LIKE HEADER, FOOTER, MODELS ETC...
	function component($name, $path=false){
		if($path==false){
			$component_path = ROOT.'/app/views/components/'.$name.'.php';
			require_once $component_path;
		}
		else{
			$component_path = ROOT.'/app/views/'.$path.'/'.$name.'.php';
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
