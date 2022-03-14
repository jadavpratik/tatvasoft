<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Validation;

use app\models\User;
use app\models\UserAddress;

class MyAddress{

    // ----------GET SINGLE ADDRESS ADDRESS----------
    public function get_address(Request $req, Response $res){
        $userAddress = new UserAddress();
        $userId = session('userId');
        $where = "AddressId = {$req->params->id} AND UserId = {$userId}"; 
        $data = $userAddress->where($where)->read();
        if(is_array($data) && count($data)>0){
            $res->status(200)->json($data[0]);
        }
        else{
            $res->status(404)->json(['message'=>'No address available!']);
        }
    }

    // ----------GET ALL ADDRESS ADDRESS----------
    public function get_all_address(Request $req, Response $res){
        $userAddress = new UserAddress();
        $data = $userAddress->where('UserId', '=', session('userId'))->read();
        if(count($data)>0){
            $res->status(200)->json($data);
        }
        else{
            $res->status(404)->json(['message'=>'No address available!']);
        }
    }    

    // ----------ADD ADDRESS----------
    public function add_address(Request $req, Response $res){

        Validation::check($req->body, [
            'add_address_street_name' => ['text'],
            'add_address_house_number' => ['string'],
            'add_address_postal_code' => ['postal-code'],
            'add_address_city' => ['text', 'min:3', 'max:20'],
            'add_address_phone' => ['phone']
        ]);

        $userId = session('userId');

        $user = new User();
        $details = $user->columns(['Email'])->where('UserId', '=', $userId)->read();

        $userAddress = new UserAddress();
        $userAddress->create([
            'UserId' => $userId,
            'AddressLine1' => $req->body->add_address_street_name,
            'AddressLine2' => $req->body->add_address_house_number,
            'City' => $req->body->add_address_city,
            'PostalCode' => $req->body->add_address_postal_code,
            'Mobile' => $req->body->add_address_phone,
            'State' => 'Gujarat',
            'Email' => $details[0]->Email
        ]);

        $res->status(200)->json(['message'=>'Address added successfully.']);

    }

    // ----------UPDATE ADDRESS----------
    public function update_address(Request $req, Response $res){

        Validation::check($req->body, [
            'edit_address_street_name' => ['text'],
            'edit_address_house_number' => ['string'],
            'edit_address_postal_code' => ['postal-code'],
            'edit_address_city' => ['text', 'min:3', 'max:20'],
            'edit_address_phone' => ['phone']
        ]);

        $userId = session('userId');
        $addressId = $req->params->id;
 
        $user = new User();
        $userAddress = new UserAddress();
 
        $details = $user->columns(['Email'])->where('UserId', '=', $userId)->read();
        $userAddress->where("AddressId = {$addressId} AND UserId = {$userId}")->update([
            'AddressLine1' => $req->body->edit_address_street_name,
            'AddressLine2' => $req->body->edit_address_house_number,
            'City' => $req->body->edit_address_city,
            'PostalCode' => $req->body->edit_address_postal_code,
            'Mobile' => $req->body->edit_address_phone,
            'State' => 'Gujarat',
            'Email' => $details[0]->Email
        ]);

        $res->status(200)->json(['message'=>'Address updated successfully.']);

    } 

    // ----------DELETE ADDRESS----------
    public function delete_address(Request $req, Response $res){
        $userId = session('userId');
        $id = $req->params->id;
        $where = "UserId = {$userId} AND AddressId = {$id}";
        $userAddress = new UserAddress();
        $userAddress->where($where)->delete();
        $res->status(200)->json(['message'=>'Address deleted successfully.']);
    }

}