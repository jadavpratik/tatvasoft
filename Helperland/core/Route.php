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

	// SET METHOD...
	public static function setMethod(){
		self::$method = $_SERVER['REQUEST_METHOD'];
		return self::$method;
	}

	// SPLIT URL...
	public static function splitUrl($route_arr){

		self::$route_url = filter_var(rtrim($route_arr), FILTER_SANITIZE_URL);
		self::$browser_url = filter_var(rtrim($_SERVER['REQUEST_URI']), FILTER_SANITIZE_URL);

		// FIX THIS PREFIX REMOVEER....
		if($_SERVER['SERVER_PORT']==80 && $_SERVER['HTTP_HOST']=='localhost'){
			// REMOVE PREFIX = "/tatvasoft/Helperland" (BECAUSE WE RUN ON LOCALHOST )
			self::$browser_url = str_replace('/tatvasoft/Helperland','', self::$browser_url);
		}

		// SET THE ROUTE_URL...
		self::$params_key = explode('/', self::$route_url);
		// SET BROWSER_URL...
		self::$params_value = explode('/', self::$browser_url);

		self::$req = new Request();
		self::$res = new Response();
	

		if(self::$route_url==self::$browser_url){
			// MATCH FOUNDED PAGE...
			page_url(self::$browser_url);
			return true;
		}
		else if(str_contains(self::$route_url, ':')){
			page_url(self::$browser_url);
			// FOR PARAMS URL...
			if(count(self::$params_key) && count(self::$params_value)){
				// LOOP WILL BE RUNNING ACCORDING TO URL ROUTE FUNCTION...
				// THAT WHY WE CHOOSE self::$params_key insted of self::$params_value...
				for($i = 0; $i<count(self::$params_key)-1; $i++){
					if(self::$params_value[$i]!==self::$params_key[$i]){
						return false;
					}
				}
				// IF URL HAS A PARAMS THEN REINITIATE REQ OBJECT...
				self::$req = new Request([self::$params_key, self::$params_value]);
				return true;
			}
			else{
				return false;
			}
		}
		else if(self::$route_url!==self::$browser_url && self::$route_url=='/*'){
			// PAGE_NOT_FOUND...
			page_url('/*');	
			return true;
		}

	}

	// GET METHOD...
	public static function get($route_arr, $callback1, $callback2=false){
		if(self::setMethod() == 'GET'){
			if(self::splitUrl($route_arr)){
				if($callback2!=false){
					$middleware = $callback1;
					$controller = $callback2;
					if(call_user_func($middleware)){
						// IF MIDDLEWARE RETURN TRUE THEN CALL CONTROLLER...
						call_user_func_array($controller, [self::$req, self::$res]);
					}
				}
				else{
					$controller = $callback1;
					call_user_func_array($controller, [self::$req, self::$res]);
				}
				exit();	
			}	
		}
	}

	// POST METHOD...
	public static function post($route_arr, $callback1, $callback2=false){
		if(self::setMethod() == 'POST'){
			if(self::splitUrl($route_arr)){
				if($callback2!=false){
					$middleware = $callback1;
					$controller = $callback2;
					if(call_user_func($middleware)){
						// IF MIDDLEWARE RETURN TRUE THEN CALL CONTROLLER...
						call_user_func_array($controller, [self::$req, self::$res]);
					}
				}
				else{
					$controller = $callback1;
					call_user_func_array($controller, [self::$req, self::$res]);
				}
				exit();	
			}	
		}
	}

}