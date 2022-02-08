<?php

namespace core;


class Middleware{

    public static function apply($name, $callback){
        if(call_user_func($name)){
            call_user_func($callback);
        }       
        else{
            echo 'Middleware Auth Failed!!!';
        }
    }

}