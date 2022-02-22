<?php

namespace app\middleware;

class Auth{

    // REDIRECT...
    public function redirect($path){
        $redirect_url = BASE_URL.$path;
        header("location:{$redirect_url}");
        return false;
    }

    // OPEN LOGIN FORM...
    public function openLoginForm(){
        session('openLoginForm', true);
        $base_url = BASE_URL;
        header("location:{$base_url}");
        return false;
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
            return false;
        }
        else{
            return true;
        }
    }

    // IS LOGGED...
    public function isLogged(){
        if(session('isLogged'))
            return true;
        else
            $this->openLoginForm();
    }

    // IS CUSTOMER...
    public function isCustomer(){
        if(session('isLogged')){
            if(session('userRole')=='customer')
                return true;
            else
                $this->redirect('/not-allowed');
        }
        else{
            $this->openLoginForm();
        }
    }

    // IS SERVICE PROVIDER...
    public function isServiceProvider(){
        if(session('isLogged')){
            if(session('userRole')=='service-provider')
                return true;
            else
               $this->redirect('/not-allowed');
        }
        else{
            $this->openLoginForm();
        }
    }

}