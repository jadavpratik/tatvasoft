<?php    

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Hash;
use app\models\User;

class Account{

	public function login(Request $req, Response $res){
		$user = new User();
		$email = $req->body->login_email;
		$where = "Email = '".$email."'";
		$result = $user->where($where)->read();
		if(count($result)==1){
			if(Hash::verify($req->body->login_password, $result[0]->Password)){
				$role = '';
				switch($result[0]->RoleId){
					case 1:
						$role = 'customer';
						break;
					case 2:
						$role = 'service-provider';
						break;
					case 3:
						$role = 'admin';
						break;
				}
				$res->status(200)->json(['role'=>$role]);
			}
			else{
				$res->status(400)->json(['result'=>"Password is Not Matched."]);
			}
		}
		else{
			$res->status(400)->json(['result'=>"User not Exists in Database"]);			
		}
	}

	public function signup(Request $req, Response $res){

		$user = new User();

		$email = $req->body->email;
		$mobile = $req->body->phone;

		$where = "Email = '".$email."' OR Mobile = $mobile";

		if($user->where($where)->exists()!=1){
			$role = null;
			switch($req->body->role){
				case 'customer':
					$role = 1;
					break;
				case 'service-provider':
					$role = 2;
					break;
				case 'admin':
					$role = 3;
					break;
				default:
					$role = 0;
					break;
			}

			// PASSWORD === CONFIRM-PASSOWRD
			if($req->body->password===$req->body->cpassword){

				// PASSWORD -> HASH
				$hash = Hash::create($req->body->password);

				$arr = ['FirstName' => $req->body->firstname,
						'LastName' => $req->body->lastname,
						'Email' => $req->body->email,
						'Mobile' => $req->body->phone,
						'Password'=> $hash,
						'RoleId' => $role];

				if(!empty($arr)){
					$user = new User();
					$result = $user->create($arr);
					if($result===1){
						$res->status(201)->json(['result'=>'Account is Created Successfully.']);
					}
				}
			}
		}
		else{
			$res->status(409)->json(['result'=>'Email Address or Mobile Number Already Exists in Database']);
		}
	}
    
}
