<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;
use core\Validation;


use app\models\PostalCode;
use app\models\UserAddress;
use app\models\User;

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
    public function get_address(Request $req, Response $res){
        if(isset($req->params->id)){
            $userAddress = new UserAddress();
            $result = $userAddress->where('UserId','=',$req->params->id)->read();    
            if($result!=""){
                $res->status(200)->json(['address'=>$result]);
            }
        }
        else{
            $res->status(400)->json(['message'=>'UserId is Required !']);
        }
    }

    // ADD ADDRESS
    public function add_address(Request $req, Response $res){
        if(isset($req->params->id)){
            $validation = Validation::check($req->body, [
                'street_name' => ['text'],
                'house_number' => [''],
                'postal_code' => ['postal-code'], 
                'city' => ['text'],
                'phone' => ['phone','length:10']
            ]);
            
            if($validation==1){
                $user = new User();
                $data = $user->column(['Email'])->where(['UserId', '=', $req->params->id])->read();

                $userAddress = new UserAddress();
                $arr = [
                    'UserId' => $req->params->id, 
                    'AddressLine1' => $req->body->street_name,
                    'AddressLine2' => $req->body->house_number,
                    'City' => $req->body->city,
                    'State' => 'Gujarat',
                    'PostalCode' => $req->body->postal_code,
                    'Email' => $data[0]->Email,
                    'Mobile' => $req->body->phone,
                ];
                $result = $userAddress->create($arr);
                if($result!="" || $result==1){
                    $res->status(200)->json(['message'=>'Address Add Successfully.']);
                }
                else{
                    $res->status(400)->json(['message'=>'Something Went Wrong !']);
                }
            }
            else{
                $res->status(400)->json(['message'=>$validation]);
            }    
        }
        else{
            $res->status(400)->json(['message'=>'UserId is Required !']);
        }
    }

}