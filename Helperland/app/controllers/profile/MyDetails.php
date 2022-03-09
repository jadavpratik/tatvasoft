<?php

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Validation;

use app\models\User;


class MyDetails{

    const MALE_ID = 1;
    const FEMALE_ID = 2;

    // ----------GET-DETAILS----------
    public function get_details(Request $req, Response $res){
        $userId = session('userId');
        $user = new User();
        $columns = ['FirstName', 'LastName', 
                    'Email', 'Mobile', 
                    'DateOfBirth', 'LanguageId', 
                    'Gender', 'UserProfilePicture'];
        $details = $user->columns($columns)->where('UserId', '=', $userId)->read();
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
            'phone' => ['phone'],
            'language' => ['integer'],
            'dob' => ['required'],
            'gender' => ['optional'],
            'avatar' => ['optional'],
        ]);

        $userId = session('userId');
        $user = new User();
        $where = "UserId != {$userId} AND Mobile = {$req->body->phone}";

        $gender = isset($req->body->gender)? $req->body->gender : 0;
        $avatar = isset($req->body->avatar)? $req->body->avatar : 'assets/img/avatar/hat.png';

        if(!$user->where($where)->exists()){
            $user->where('UserId', '=', $userId)->update([
                'FirstName' => $req->body->firstname,
                'LastName' => $req->body->lastname,
                'Mobile' => $req->body->phone,
                'LanguageId' => $req->body->language,
                'DateOfBirth' => $req->body->dob,
                'Gender' => $gender,
                'UserProfilePicture' => $avatar,
                'ModifiedDate'=> date('Y-m-d H:i:s')
            ]);    
            $res->status(200)->json(['message'=>'Profile Updated Successfully.']);
        }
        else{
            $res->status(401)->json(['message'=>'Email or Mobile already exists in Database!']);
        }

    }
}