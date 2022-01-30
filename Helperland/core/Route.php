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
	public static $method = 'GET';

	public static function splitUrl($route_arr){

		self::$method = $_SERVER['REQUEST_METHOD'];
		self::$params_key = filter_var(rtrim($route_arr), FILTER_SANITIZE_URL);
		self::$params_value = filter_var(rtrim($_SERVER['REQUEST_URI']), FILTER_SANITIZE_URL);

		if($_SERVER['SERVER_PORT']==80 && $_SERVER['HTTP_HOST']=='localhost'){
			// REMOVE PREFIX = "/tatvasoft/Helperland" (BECAUSE WE RUN ON LOCALHOST )
			self::$params_value = str_replace('/tatvasoft/Helperland', '', self::$params_value);
		}

		self::$params_value = explode('/', self::$params_value);
		self::$params_key = explode('/', self::$params_key);

		if(self::$params_key[1]!==''){
			// SET THE ROUTE_URL...
			self::$route_url = '/'.self::$params_key[1];
		}
		if(self::$params_value[1]!==''){
			// SET BROWSER_URL...
			self::$browser_url = '/'.self::$params_value[1];
		}

		self::$req = new Request([self::$params_key, self::$params_value]);
		self::$res = new Response();

		if(self::$route_url==self::$browser_url){
			// MATCH FOUNDED PAGE...
			set_page_url(self::$route_url);	
			return true;
		}
		else if(self::$route_url!==self::$browser_url && self::$route_url=='/*'){
			// PAGE_NOT_FOUND...
			set_page_url('/*');	
			return true;
		}

	}

	// GET METHOD...
	public static function get($route_arr, $callback){
		if(self::$method == 'GET'){
			if(self::splitUrl($route_arr)==1){
				call_user_func_array($callback, [self::$req, self::$res]);
				exit();
			}
		}
	}

	// POST METHOD...
	public static function post($route_arr, $callback){
		if(self::$method == 'POST'){
			if(self::splitUrl($route_arr)==1){
				call_user_func_array($callback, [self::$req, self::$res]);
				exit();
			}
		}		
	}

	// DELETE METHOD...

	// PUT METHOD...

	// MIDDLEWARE METHOD...
	public function middleware($name){
		echo $name;
	}

}