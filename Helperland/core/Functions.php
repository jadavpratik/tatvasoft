<?php

	$title = 'Index';
	$page_url = '/';

	function assets($path){
		return BASE_URL.'/'.$path;
	}

	function url($path){
		return BASE_URL.$path;
	}

	function set_page_url($url){
		global $page_url;
		$page_url = $url;
	}

	function page_url(){
		global $page_url;
		return $page_url;
	}

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

	function component($name){
		$component_path = ROOT.'/app/views/components/'.$name.'.php';
		require_once $component_path;
	}