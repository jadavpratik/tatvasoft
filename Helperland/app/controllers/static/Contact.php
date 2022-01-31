<?php

namespace app\controllers\static;

use core\Request;
use core\Response;
use core\File;
use app\models\Contact as ContactModel;

class Contact{

	public function view(Request $req, Response $res){
		$res->render('static/contact');	
	}

	public function submit(Request $req, Response $res){

		// SAVE A UPLOADED FILE PATH...
		$filePath = File::upload($req->files->Attachment, 'upload/contact/');

		$arr = array('Name' => $req->body->FirstName.' '.$req->body->LastName,
					 'Email' => $req->body->Email,
					 'PhoneNumber' => $req->body->PhoneNumber,
					 'Subject' => $req->body->Subject,
					 'Message' => $req->body->Message,
					 'UploadFileName' => $filePath);

		if(!empty($arr)){
			$contact = new ContactModel();
			echo $contact->create($arr);
		}
	}

}