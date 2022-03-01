<?php

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Validation;

use app\models\User;


class MyDetails{

    // ----------GET-DETAILS----------
    public function get_details(Request $req, Response $res){
        $userId = session('userId');
        $user = new User();
        $details = $user->where('UserId', '=', $userId)->read();
        if(is_array($details)){
            // PASSWORD IS ALSO COMING FROM DATABASE (PENDING)...
            $res->status(200)->json($details[0]);
        }
        else{
            $res->status(400)->json(['message'=> 'No details available!']);            
        }
    }

    // ----------UPDATE-DETAILS----------
    public function update_details(Request $req, Response $res){

        Validation::check($req->body, [
            'firstname' => ['text', 'min:3', 'max:20'],
            'lastname' => ['text', 'min:3', 'max:20'],
            'email' => ['email'],
            'phone' => ['phone'],
            'language' => ['integer'],
            'dob' => ['required']
        ]);

        $userId = session('userId');
        $user = new User();
        $where = "UserId != {$userId} AND (Email = '{$req->body->email}' OR Mobile = {$req->body->phone})";

        if(!$user->where($where)->exists()){
            $user->where('UserId', '=', $userId)->update([
                'FirstName' => $req->body->firstname,
                'LastName' => $req->body->lastname,
                'Email' => $req->body->email,
                'Mobile' => $req->body->phone,
                'LanguageId' => $req->body->language,
                'DateOfBirth' => $req->body->dob,
                'ModifiedDate'=> timestamp()
            ]);    
            $res->status(200)->json(['message'=>'Profile Updated Successfully.']);
        }
        else{
            $res->status(401)->json(['message'=>'Email or Mobile already exists in Database!']);
        }

    }
}