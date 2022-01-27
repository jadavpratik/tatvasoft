<?php

namespace app\controllers\static;

use core\Request;
use core\Response;

class Contact{

	public function view(Request $req, Response $res){
		$res->render('static/contact');	
	}

}