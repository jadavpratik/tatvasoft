<?php

namespace app\middleware;

class Auth{

    public function user(){
        if(session('login')){
            return true;
        }
        else{
            return false;
        }
    }

}