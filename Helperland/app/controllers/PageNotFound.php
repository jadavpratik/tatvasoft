<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Database;
use app\models\User;

class PageNotFound{

	public function view(Request $req, Response $res){
		// $userObj = new User();
		// echo "<pre>";
		// print_r();
		// $res->json($userObj->read());
		// $obj = new Database();
		// $arr = ['id'=>12,
		// 		'name'=>'Pruthviraj',
		// 		'email'=>'pruthvi@email.com',
		// 		'password'=>'P123'];
		// $data = $obj->table('user')->read();
		// $data = $obj->table('user')->create($arr);
		// $data = $obj->table('user')->where('id', '=', 1)->update($arr);
		// $data = $obj->table('user')->where('id','=',1)->delete();
		// $res->json($data);
		// $res->redirect('/');
		// $res->render('page_not_found');
	}

}