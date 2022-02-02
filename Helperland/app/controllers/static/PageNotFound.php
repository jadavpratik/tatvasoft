<?php

namespace app\controllers\static;

use core\Request;
use core\Response;

class PageNotFound{

	public function view(Request $req, Response $res){
		$res->render('static/page-not-found');
	}

}