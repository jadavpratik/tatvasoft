<?php

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
			case '/about' :
				$title = 'About'; 
				break;
		}
		echo $title;
	}

	// RETURN COMPONENTS LIKE HEADER, FOOTER ETC...
	function component($name){
		$component_path = ROOT.'/app/views/components/'.$name.'.php';
		require_once $component_path;
	}

	// SESSION FUNCTIONS...
	function session_get($key){
		return $_SESSION[$key];
	}

	function session_set($key, $value){
		return $_SESSION[$key] = $value;
	}