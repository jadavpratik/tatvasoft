<?php

namespace app\middleware;


class Auth{

    public function user(){
        return session('login');
    }

}