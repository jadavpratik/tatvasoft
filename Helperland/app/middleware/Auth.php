<?php

namespace app\middleware;

class Auth{

    public function alreadyLogged(){
        if(session('isLogged')){
            $base_url = BASE_URL;
            switch(session('userRole')){
                case 'customer':
                    $base_url = BASE_URL.'/customer';
                    break;
                case 'service-provider':
                    $base_url = BASE_URL.'/service-provider';
                    break;
                case 'admin':
                    $base_url = BASE_URL.'/admin';
                    break;
            }
            header("location:{$base_url}");
            return false;
        }
        else{
            return true;
        }
    }

    public function isLogged(){
        if(session('isLogged')){
            return true;
        }
        else{
            session('open-login-form', true);
            $base_url = BASE_URL;
            header("location:{$base_url}");
            return false;
        }
    }



}