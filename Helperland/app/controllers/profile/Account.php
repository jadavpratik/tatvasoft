<?php    

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Hash;
use core\Validation;
use core\Mail;

use app\models\User;
use app\models\OTP;

class Account{

	// ---------------SET USER ROLE ID---------------------------
	public function setUserRoleId($roleName){
		switch($roleName){
			case 'customer':
				return 1;
			case 'service-provider':
				return 2;
			case 'admin':
				return 3;
		}
	}

	// ---------------SET USER ROLE NAME---------------------------
	public function setUserRoleName($roleId){
		switch($roleId){
			case 1:
				return 'customer';
			case 2:
				return 'service-provider';
			case 3:
				return 'admin';
		}
	}
	
	// -----------------------------SIGNUP------------------------------------
	public function signup(Request $req, Response $res){

		Validation::check($req->body, [
			'firstname' => ['text', 'min:3', 'max:20'],
			'lastname' => ['text', 'min:3', 'max:20'],
			'email' => ['email'],
			'phone' => ['phone'],
			'role' => ['text'],
			'password' => ['password'],
			'cpassword' => ['confirm-password'],
		]);

		$user = new User();

		$email = $req->body->email;
		$mobile = $req->body->phone;
		$where = "Email = '{$email}' OR Mobile = $mobile";

		if(!$user->where($where)->exists()){
			$role = $this->setUserRoleId($req->body->role);
			if($role==1 || $role==2 || $role==3){
				$hash = Hash::create($req->body->password);	
				$user->create([
					'FirstName' => $req->body->firstname,
					'LastName' => $req->body->lastname,
					'Email' => $req->body->email,
					'Mobile' => $req->body->phone,
					'Password'=> $hash,
					'RoleId' => $role,
					'CreatedDate' => timestamp()
				]);
				$res->status(201)->json(['message'=>'Account is Created Successfully.']);
			}
			else{
				$res->status(401)->json(['message'=>'Role Id Not Matched!']);
			}
		}
		else{
			$res->status(409)->json(['message'=>'Email Address or Mobile Number Already Exists in Database']);
		}		
	}

	// -----------------------------LOGIN------------------------------------
	public function login(Request $req, Response $res){

		// ALSO CHECK REMEMBER ME PENDING....
		Validation::check($req->body, [
			'login_email' => ['email'],
			'login_password' => ['password']
		]);

		$email = $req->body->login_email;
		$password = $req->body->login_password;

		$user = new User();
		$where = "Email = '{$email}'";

		if($user->where($where)->exists()){

			$result = $user->where($where)->read();
			$userId = $result[0]->UserId;
			$userRole = $result[0]->RoleId;
			$userPassword = $result[0]->Password;
			$userName = $result[0]->FirstName.' '.$result[0]->LastName;

			if(Hash::verify($password, $userPassword)){
				$userRole = $this->setUserRoleName($userRole);
				session('isLogged', true);
				session('userId', $userId);
				session('userRole', $userRole);
				session('userName', $userName);
				$res->status(200)->json(['role'=>$userRole, 'message'=>"Login Successfully."]);
			}
			else{
				$res->status(401)->json(['message'=>"Password is Not Matched."]);
			}
		}
		else{
			$res->status(401)->json(['message'=>"User not Exists in Database"]);			
		}		
	}

	// -----------------------------LOGOUT------------------------------------
	public function logout(Request $req, Response $res){
		// DESTORY THE SESSION...
		unset($_SESSION['isLogged']);
		unset($_SESSION['userId']);
		unset($_SESSION['userRole']);
		unset($_SESSION['userName']);
		session('logout', true);
		$res->redirect('/');
	}

	// -----------------------------FORGOT-PASSWORD------------------------------------
	public function forgot_password(Request $req, Response $res){

		Validation::check($req->body, [
			'email' => ['email']
		]);

		$email = $req->body->email;
		$user = new User();
		if($user->where('Email', '=', $email)->exists()){
			$otp = rand(1000, 9999);// GENERATE OTP...
			$obj = new OTP();
			if($obj->where('email', '=', $email)->exists()){
				$obj->where('email', '=', $email)->delete();
			}
			// STORE OTP IN DATABASE...
			$obj->create(['email'=> $email, 'otp' => $otp ]);
			// ----------WITHOUT MAIL----------
			$res->status(200)->json(['otp'=>$otp, 'message'=>'OTP Sent On Your Email Address']);

			// ---------ACTIVE MAIL SYSTEM---------
			// $subject = 'Helperland';
			// $body = 'Your one time otp = '.$otp;
			// $recipient = $email;
			// if(Mail::send($recipient, $subject, $body)){
			// 	$otp = '';
			// 	$res->status(200)->json(['otp'=>$otp, 'message'=> 'OTP Sent On Your Email Address']);
			// }
			// else{
			// 	$res->status(500)->json(['otp'=>$otp, 'message'=> "OTP Can't be sent on your Email Address !"]);
			// }
		}
		else{
			$res->status(401)->json(['message'=>'User not Exists in Database.']);
		}		
	}

	// -----------------------------VERIFY-OTP------------------------------------
	public function verify_otp(Request $req, Response $res){

		Validation::check($req->body, [
			'otp' => ['integer', 'length:4'],
			'email' => ['email']
		]);

		$obj = new OTP();
		$email = $req->body->email;
		$result = $obj->where('email', '=', $email)->read();
		if($result[0]->otp == $req->body->otp){
			if($obj->where('email', '=', $email)->delete()){
				$res->status(200)->json(['message'=>'OTP Matched.']);
			}
		}
		else{
			$res->status(401)->json(['message'=> 'OTP Not Matched!!!']);
		}		
	
	}

	// -----------------------------SET-NEW-PASSWORD------------------------------------
	public function set_new_password(Request $req, Response $res){

		Validation::check($req->body, [
			'password' => ['password'],
			'cpassword' => ['confirm-password'],
			'email' => ['email'],
		]);

		$user = new User();
		$hash = Hash::create($req->body->password);
		$email = $req->body->email;
		$user->where('Email','=', $email)->update([
			'Password' => $hash,
			'ModifiedDate' => timestamp(),
		]);
		$res->status(200)->json(['message'=>'Password Updated Successfully.']);
	}    

	// -----------------------------CHANGE-PASSWORD------------------------------------
	public function change_password(Request $req, Response $res){
		/* 
			**********BUG**********
			CONFIRM-PASSWORD===PASSWORD 
			CONFIRM-PASSWORD===PASSWORD
			SO WE ADDED NEW KEY AS FLAG NEW-PASSWORD
		*/
		Validation::check($req->body, [
			'change_password_old' => ['required'],
			'change_password_new' => ['password', 'new-password'],
			'change_password_confirm' => ['confirm-password']
		]);

		$userId = session('userId');

		$user = new User();
		$data = $user->where('UserId', '=', $userId)->read();

		// ALL PASSWORD...
		$dbPassword = $data[0]->Password;
		$oldPassword = $req->body->change_password_old;
		$newPassword = $req->body->change_password_new;
		$confirmPassword = $req->body->change_password_confirm;
		$hash = Hash::create($confirmPassword);

		if(Hash::verify($oldPassword, $dbPassword)){
			$user->where('UserId', '=', $userId)->update([
				'UserId' => $userId,
				'Password' => $hash,
				'ModifiedDate' => timestamp(),
			]);	
			$res->status(200)->json(['message'=>'Password Change Successfully.']);	
		}
		else{
			$res->status(401)->json(['message'=>'Old password is wrong!']);
		}
	}    

}
