<?php

namespace app\middleware;

class Auth{

    public function user(){
        if(session('login')){
            return true;
        }
        else{
            session('need-authentication', true);
            $base_url = BASE_URL;
            header("location:{$base_url}");
        }
    }

}