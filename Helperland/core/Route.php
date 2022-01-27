<?php

namespace core;

use core\Request;
use core\Response;

class Route{

	public static $browser_url = '/';
	public static $route_url = '/';
	public static $params_key = [];
	public static $params_value = [];
	public static $req;
	public static $res;

	public static function splitUrl($route_arr){

		// WORK ON BROWSER_URL...
		self::$params_key = filter_var(rtrim($route_arr),FILTER_SANITIZE_URL);
		self::$params_value = filter_var(rtrim($_SERVER['REQUEST_URI']),FILTER_SANITIZE_URL);

		if($_SERVER['SERVER_PORT']==80 && $_SERVER['HTTP_HOST']=='localhost'){
			// REMOVE PREFIX = "/tatvasoft/Helperland" (BECAUSE WE RUN ON LOCALHOST )
			self::$params_value = str_replace('/tatvasoft/Helperland', '', self::$params_value);
		}

		self::$params_value = explode('/', self::$params_value);
		self::$params_key = explode('/', self::$params_key);

		if(self::$params_key[1]!==''){
			self::$route_url = '/'.self::$params_key[1];
		}
		if(self::$params_value[1]!==''){
			self::$browser_url = '/'.self::$params_value[1];			
		}

		if(self::$route_url==self::$browser_url){
			set_page_url(self::$route_url);	
			self::$req = new Request([self::$params_key, self::$params_value]);
			self::$res = new Response();
			return true;
		}
	}

	// GET METHOD...
	public static function get($route_arr, $callback){
		if(self::splitUrl($route_arr)==1){
			call_user_func_array($callback, [self::$req, self::$res]);
			exit();
		}
	}

	// POST METHOD...

	// DELETE METHOD...

	// PUT METHOD...

}