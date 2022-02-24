<?php

namespace app\controllers\pages;

use core\Request;
use core\Response;

use app\models\User;

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
        if(session('isLogged')){
            $user = new User();
            $data = '';
            if(!$user->error){
                $columns = ['FirstName', 'LastName', 'Email', 'Mobile'];
                $data = $user->columns($columns)->where('UserId', '=', session('userId'))->read();
            }
            $res->render('static/contact', ['data'=>$data[0]]);	
        }
        else{
            $res->render('static/contact');	
        }
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

}