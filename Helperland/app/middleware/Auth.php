<?php

namespace app\middleware;

use core\Response;

class Auth{

    private $res = null;

    public function __construct(){
        $this->res = new Response();
    }

    // ALREADY LOGGED...
    public function alreadyLogged(){
        if(session('isLogged')){
            switch(session('userRole')){
                case 'customer':
                    $redirect_url = BASE_URL.'/customer';
                    break;
                case 'service-provider':
                    $redirect_url = BASE_URL.'/service-provider';
                    break;
                case 'admin':
                    $redirect_url = BASE_URL.'/admin';
                    break;
            }
            header("location:{$redirect_url}");
            exit();
        }
        else{
            return true;
        }
    }

    // IS CUSTOMER...
    public function isCustomer(){
        if(session('isLogged')){
            if(session('userRole')=='customer'){
                return true;
            }
            else{
                $this->res->status(403)->json(['error'=>'You are not allowed to access this page']);
                exit();
            }
        }
        else if($_SERVER['REQUEST_METHOD']!=='GET'){
            $this->res->status(401)->json(['error'=>'You need to login!']);
            exit();
        }
        else{
            $this->openLoginForm();
        }
    }

    // IS SERVICE PROVIDER...
    public function isServiceProvider(){
        if(session('isLogged')){
            if(session('userRole')=='service-provider'){
                return true;
            }
            else{
                $this->res->status(403)->json(['error'=>'You are not allowed to access this page']);
                exit();
            }
        }
        else if($_SERVER['REQUEST_METHOD']!=='GET'){
            $this->res->status(401)->json(['error'=>'You need to login!']);
            exit();
        }
        else{
            $this->openLoginForm();
        }
    }

    // OPEN LOGIN FORM...
    public function openLoginForm(){
        session('openLoginForm', true);
        $base_url = BASE_URL;
        header("location:{$base_url}");
        exit();
    }
                
}