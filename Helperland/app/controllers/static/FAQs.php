<?php

namespace app\controllers\static;

use core\Request;
use core\Response;

class FAQs{

	public function view(Request $req, Response $res){
		$res->render('static/faqs');	
	}

}