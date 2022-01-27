<?php

namespace app\controllers;

use core\Request;
use core\Response;

class PageNotFound{

	public function view(Request $req, Response $res){
		$res->render('page_not_found');	
	}

}