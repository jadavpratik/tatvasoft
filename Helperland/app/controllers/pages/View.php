<?php

namespace app\controllers\pages;

use core\Request;
use core\Response;
use core\Validation;
use core\File;
use core\Mail;

use app\models\Contact;

class View{

    // **********STATIC-PAGES**********

    // HOME...
    public function home(Request $req, Response $res){
		$res->render('static/home');	
	}

    // FAQs...
    public function faqs(Request $req, Response $res){
		$res->render('static/faqs');	
    }

    // PRICES...
    public function prices(Request $req, Response $res){
		$res->render('static/prices');	
	}

    // CONTACT...
    public function contact(Request $req, Response $res){
		$res->render('static/contact');	
	}

    // ABOUT...
	public function about(Request $req, Response $res){
		$res->render('static/about');	
	}

    // GUARANTEE...
    public function guarantee(Request $req, Response $res){
        $res->render('static/guarantee');
    }

    // **********CUSTOMER**********

    // BOOK-NOW...
    public function booknow(Request $req, Response $res){
        $res->render('book-now/index');
    }

    // CUSTOMER-SIGNUP...
    public function customer_signup(Request $req, Response $res){
		$res->render('customer/signup');
	}

    // CUSTOMER-PROFILE...
    public function customer_profile(Request $req, Response $res){
        $res->render('customer/index');
    }

    // **********SERVICE-PROVIDER**********

    // SP-SIGNUP...
    public function sp_signup(Request $req, Response $res){
        $res->render('service-provider/signup');
    }

    // SP-PROFILE...
    public function sp_profile(Request $req, Response $res){
        $res->render('service-provider/index');
    }

    // **********COMPONENTS**********

    // LOGIN...
    public function login(Request $req, Response $res){
		session('openLoginForm', true);
		$res->redirect('/');
	}

    // FORGOT PASSWORD...
	public function forgot_password(Request $req, Response $res){
		session('openForgotPasswordForm', true);
		$res->redirect('/');
	}

    // **********ERROR & AUTH REDIRECT PAGES**********

    // PAGE-NOT-FOUND...
	public function page_not_found(Request $req, Response $res){
		$res->render('static/page-not-found');
	}

    // NOT-ALLOWED...
	public function not_allowed(Request $req, Response $res){
		$res->render('static/not-allowed');
	}

    // **********CONTACT-SUBMIT**********

	public function contact_submit(Request $req, Response $res){

		$validation = Validation::check($req->body, [
			'firstname' => ['text', 'min:3', 'max:10'],
			'lastname' => ['text', 'min:3', 'max:10'],
			'phone' => ['phone', 'length:10'],
			'email' => ['email'],
			'message' => ['text'],
			'subject' => ['text'],
		]);

		if($validation==1){

			// SAVE A UPLOADED FILE PATH...
			$filePath = null;
			if(isset($req->files->attachment)){
				if($req->files->attachment['error']==0){
					$filePath = File::upload($req->files->attachment, 'contact/');
				}	
			}

			$arr = array('Name' => $req->body->firstname.' '.$req->body->lastname,
						'Email' => $req->body->email,
						'PhoneNumber' => $req->body->phone,
						'Subject' => $req->body->subject,
						'Message' => $req->body->message,
						'UploadFileName' => $filePath,
						'CreatedOn' => timestamp());

			$contact = new Contact();
			$result = $contact->create($arr);

			if($result){
				$res->status(200)->json(['message'=>"Form Submitted Successfully."]);

				// $emailBody = $req->body->message;
				// $emailSubject = $req->body->subject;
				// $recipient = 'RECIPIENT EMAIL ADDRESS';
				// if(Mail::send($recipient, $emailSubject, $emailBody)){
				// 	$res->status(200)->json(['message'=>"Form Submitted Successfully."]);
				// }

			}
			else{
				$res->status(500)->json(['message'=>'Internal Server Error']);
			}	
		}
		else{
			$res->status(400)->json($validation);
		}
	}

}