<?php

namespace app\controllers\static;

use core\Request;
use core\Response;
use core\File;
// use core\Validation;
use app\models\Contact as ContactModel;

class Contact{

	public function view(Request $req, Response $res){
		$res->render('static/contact');	
	}

	public function submit(Request $req, Response $res){

		// SAVE A UPLOADED FILE PATH...
		$filePath = File::upload($req->files->attachment, 'upload/contact/');

		$arr = array('Name' => $req->body->firstname.' '.$req->body->lastname,
					 'Email' => $req->body->email,
					 'PhoneNumber' => $req->body->phone,
					 'Subject' => $req->body->subject,
					 'Message' => $req->body->message,
					 'UploadFileName' => $filePath);

		$contact = new ContactModel();
		$result = $contact->create($arr);

		if($result!=='' && $result!=null){
			$res->status(200)->json(['result'=>"Form Submitted Successfully."]);			
		}
		else{
			$res->status(400)->json(['error'=>'Something Went Wrong!!!']);
		}
	}

}