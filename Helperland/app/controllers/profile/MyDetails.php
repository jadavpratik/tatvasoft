<?php

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Validation;

use app\models\User;


class MyDetails{

    public function update(Request $req, Response $res){

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
                'LanguageId' => $this->languageNumber($req->body->language),
                'DateOfBirth' => $req->body->dob,
                'ModifiedDate'=> timestamp()
            ]);    
            $res->status(200)->json(['message'=>'Profile Updated Successfully.']);
        }
        else{
            $res->status(401)->json(['message'=>'Email or Mobile already exists in Database!']);
        }

    }


    public function languageNumber($lang){
        switch($lang){
            case 'english':
                return 1;
            case 'hindi':
                return 2;
        }
    }

}