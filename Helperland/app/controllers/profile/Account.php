<?php    

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Hash;
use core\Validation;
use app\models\User;
use core\Mail;

class Account{

	// -----------------------------SET-NEW-PASSWORD------------------------------------
	public function set_new_password(Request $req, Response $res){

		$validation = Validation::check($req->body, [
			'set_new_password' => ['password'],
			'set_new_cpassword' => ['confirm-password']
		]);

		if($validation==1){
			if($req->body->set_new_password==$req->body->set_new_cpassword){
				$user = new User();
				$hash = Hash::create($req->body->set_new_password);
				$email = session('email');
				$result = $user->where('Email','=', "'{$email}'")->update(['Password'=>$hash]);
				if($result==1){
					unset($_SESSION['email']);
					$res->status(200)->json(['message'=>'Password Updated Successfully.']);
				}
				else{
					$res->status(500)->json(['message'=>'Internal Server Error']);
				}
			}
			else{
				$res->status(401)->json(['message'=>'Password & Confirm Password Not Matched!!!']);
			}	
		}
		else{
			$res->status(400)->json(['message'=>$validation]);
		}
	}

	public function check_otp(Request $req, Response $res){

		$validation = Validation::check($req->body, [
			'otp' => ['length:4']
		]);

		if($validation==1){
			if($req->body->otp==session('otp')){
				unset($_SESSION['otp']);
				$res->status(200)->json(['message'=>'OTP Matched.']);
			}
			else{
				$res->status(401)->json(['message'=>'OTP Not Matched!!!']);
			}	
		}
		else{
			$res->status(400)->json(['message'=>$validation]);			
		}
	}

	// -----------------------------FORGOT-PASSWORD------------------------------------
	public function forgot_password(Request $req, Response $res){

		$validation = Validation::check($req->body, [
			'forgot_password_email' => ['email']
		]);

		if($validation==1){
			$user = new User();
			if($user->where('Email', '=', "'{$req->body->forgot_password_email}'")->exists()){
				// GENERATE OTP...
				$otp = rand(1000, 9999);
				// STORE OTP IN SESSION...
				session('otp', $otp);
				session('email', $req->body->forgot_password_email);
				$recipient = $req->body->forgot_password_email;
				// Mail::send($recipient, $subject, $body);
				$res->status(200)->json(['otp'=>$otp, 'message'=>'OTP Sent On Your Email Address']);
			}
			else{
				$res->status(401)->json(['message'=>'User not Exists in Database.']);
			}	
		}
		else{
			$res->status(400)->json(['message'=>$validation]);			
		}
	}

	// -----------------------------LOGOUT------------------------------------
	public function logout(Request $req, Response $res){
		// DESTORY THE SESSION...
		unset($_SESSION['isLogged']);
		unset($_SESSION['userRole']);
		unset($_SESSION['userName']);
		session('logout', true);
		$res->redirect('/');
	}

	// -----------------------------LOGIN------------------------------------
	public function login(Request $req, Response $res){

		$validation = Validation::check($req->body, [
			'login_email' => ['email'],
			'login_password' => ['password']
		]);

		if($validation==1){
			$user = new User();
			$email = $req->body->login_email;
			$where = "Email = '{$email}'";
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
					// SET THE SESSION...
					session('isLogged', true);
					session('userId', $result[0]->UserId);
					session('userRole', $role);
					session('userName', $result[0]->FirstName.' '.$result[0]->LastName);
					// WE NEED TO REDIRECT BY JAVASCRIPT...
					// $res->redirect('/');
					$res->status(200)->json(['role'=>$role, 'message'=>"Login Successfully."]);
				}
				else{
					$res->status(401)->json(['message'=>"Password is Not Matched."]);
				}
			}
			else{
				$res->status(401)->json(['message'=>"User not Exists in Database"]);			
			}	
		}
		else{
			$res->status(400)->json(['message'=>$validation]);			
		}
	}


	// -----------------------------SIGNUP------------------------------------
	public function signup(Request $req, Response $res){

		$validation = Validation::check($req->body, [
			'firstname' => ['text', 'min:3', 'max:10'],
			'lastname' => ['text', 'min:3', 'max:10'],
			'email' => ['email'],
			'phone' => ['phone'],
			'role' => ['text'],
			'password' => ['password'],
			'cpassword' => ['confirm-password'],
		]);

		if($validation==1){
			$user = new User();

			$email = $req->body->email;
			$mobile = $req->body->phone;
	
			$where = "Email = '{$email}' OR Mobile = $mobile";
	
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
				}
				if($role!=null && ($role==1 || $role==2 || $role==3)){
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
							if($result==1){
								$res->status(201)->json(['message'=>'Account is Created Successfully.']);
							}
						}
					}
				}
				else{
					$res->status(401)->json(['message'=>'Role Id Not Matched!']);
				}
			}
			else{
				$res->status(409)->json(['message'=>'Email Address or Mobile Number Already Exists in Database']);
			}	
		}
		else{
			$res->status(400)->json(['message'=>$validation]);
		}
	}
    
}
