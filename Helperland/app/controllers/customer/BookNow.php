<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;
use core\Validation;


use app\models\PostalCode;
use app\models\UserAddress;

class BookNow{


    public function view(Request $req, Response $res){
        $res->render('customer/book-now');
    }

    // CHECK POSTAL CODE 
    public function check_postal_code(Request $req, Response $res){
        $validation = Validation::check($req->body, [
            'postal_code' => ['postal-code']
        ]);

        if($validation==1){
            $obj = new PostalCode();
            $result = $obj->where('ZipCodeValue','=', $req->body->postal_code)->exists();
            if($result!=""){
                $res->status(200)->json(['message'=>'PostalCode is Exists in Database.']);
            }
            else{
                $res->status(400)->json(['message'=>'PostalCode Not Exists in Database.']);
            }
        }
        else{
            $res->json(['message'=>$validation]);
        }

    }

    // GET LOGGED USER ADDRESS...
    public function get_user_address(Request $req, Response $res){
        if(isset($req->params->id)){
            $user = new UserAddress();
            $result = $user->where('UserId','=',$req->params->id)->read();    
            if($result!=""){
                $res->status(200)->json(['address'=>$result]);
            }
        }
        else{
            $res->status(400)->json(['message'=>'User Id Not Avaliable!']);
        }
    }

}