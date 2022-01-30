<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\File;

class Test{

	public function view(Request $req, Response $res){
		$res->render('test');
	}

	public function upload(Request $req, Response $res){
		echo "<pre>";
		File::upload($req->files->image, 'upload/images/');
	}

}