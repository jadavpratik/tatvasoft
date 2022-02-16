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
            if($result==1){
                $res->status(200)->json(['message'=>'PostalCode is Exists in Database.']);
            }
            else{
                $res->status(400)->json(['message'=>'PostalCode Not Exists in Database.']);
            }
        }
        else{
            $res->status(400)->json(['message'=>$validation]);
        }

    }

    // GET LOGGED USER ADDRESS...
    public function get_address(Request $req, Response $res){
        if(session('userId')){
            $userAddress = new UserAddress();
            $result = $userAddress->where('UserId', '=', session('userId'))->read();
            if(gettype($result)=='array'){
                $res->status(200)->json(['address'=>$result]);
            }    
        }
        else{
            $res->status(401)->json(['message'=>"User Not Logged!"]);
        }
    }

    // ADD ADDRESS
    public function add_address(Request $req, Response $res){
        if(session('userId')){
            $validation = Validation::check($req->body, [
                'street_name' => ['text'],
                'house_number' => ['required'],
                'postal_code' => ['postal-code'], 
                'city' => ['text'],
                'phone' => ['phone','length:10']
            ]);
            
            if($validation==1){
                $user = new User();
                $data = $user->column(['Email'])->where(['UserId', '=', session('userId')])->read();

                $userAddress = new UserAddress();
                $arr = [
                    'UserId' => session('userId'), 
                    'AddressLine1' => $req->body->street_name,
                    'AddressLine2' => $req->body->house_number,
                    'City' => $req->body->city,
                    'State' => 'Gujarat',
                    'PostalCode' => $req->body->postal_code,
                    'Email' => $data[0]->Email,
                    'Mobile' => $req->body->phone,
                ];
                $result = $userAddress->create($arr);
                if($result==1){
                    $res->status(201)->json(['message'=>'Address Add Successfully.']);
                }
                else{
                    $res->status(500)->json(['message'=>'Internal Server Error !']);
                }
            }
            else{
                $res->status(400)->json(['message'=>$validation]);
            }    
        }
        else{
            $res->status(401)->json(['message'=>'User Not Logged !']);
        }
    }

    public function book_service(Request $req, Response $res){
        $validation = Validation::check($req->body, [
            'postal_code' => ['required','postal-code'],
            'date' => ['required'],
            'time' => ['required'],
            'duration' => ['required'],
            'extra' => ['optional'],
            'extra_time' => ['optional'],
            'comments' => ['optional'],
            'has_pets' => ['optional'],
            'address_id' => ['required'],
            'service_provider_id' => ['optional'],
            
        ]);

        if($validation==1){
            $res->status(201)->json(['message'=>'Validation Completed']);
        }
        else{
            $res->status(400)->json(['message'=>$validation]);
        }
        // SERVICE POOL [SEND MAIL TO ALL SP ACCORDING TO POSTAL CODE]
        // FIND SERVICE_PROVIDER BY POSTAL CODE AND USERROLEID 2

        // DIRECT ASSIGNMENT OF USER...
    }

}