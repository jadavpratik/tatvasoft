<?php

namespace app\controllers\static;

use core\Request;
use core\Response;

class Home{

	public function view(Request $req, Response $res){
		$res->render('static/home');	
	}

}