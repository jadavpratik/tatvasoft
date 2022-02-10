<?php

namespace app\controllers\static;

use core\Request;
use core\Response;
use core\File;
use core\Validation;
use app\models\Contact as ContactModel;

class Contact{

	public function view(Request $req, Response $res){
		$res->render('static/contact');	
	}

	public function submit(Request $req, Response $res){

		$validation_arr = [
			'firstname' => ['text', 'min:3', 'max:10'],
			'lastname' => ['text', 'min:3', 'max:10'],
			'phone' => ['phone', 'length:10'],
			'email' => ['email'],
			'message' => ['text'],
			'subject' => ['text'],
		];

		$validation_response = Validation::check($req->body, $validation_arr);

		if($validation_response==1 && gettype($validation_response)!='array'){
			// SAVE A UPLOADED FILE PATH...
			$filePath = null;
			if(isset($req->files->attachment)){
				if($req->files->attachment['error']==0){
					$filePath = File::upload($req->files->attachment, 'upload/contact/');
				}	
			}

			$arr = array('Name' => $req->body->firstname.' '.$req->body->lastname,
						'Email' => $req->body->email,
						'PhoneNumber' => $req->body->phone,
						'Subject' => $req->body->subject,
						'Message' => $req->body->message,
						'UploadFileName' => $filePath);

			$contact = new ContactModel();
			$result = $contact->create($arr);

			if($result!='' && $result!=null){
				$res->status(200)->json(['message'=>"Form Submitted Successfully."]);			
			}
			else{
				$res->status(500)->json(['message'=>'Internal Server Error']);
			}	
		}
		else{
			$res->status(400)->json(['error'=>$validation_response]);
		}
	}

}