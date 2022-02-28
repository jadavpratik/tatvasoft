<?php

namespace app\controllers\profile;

use core\Request;
use core\Response;
use core\Validation;

use app\models\User;
use app\models\UserAddress;

class MyAddress{

    // ----------ADD ADDRESS----------
    public function add(Request $req, Response $res){

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
            'City' => $req->body->add_address_street_name,
            'PostalCode' => $req->body->add_address_postal_code,
            'Mobile' => $req->body->add_address_phone,
            'State' => 'Gujarat',
            'Email' => $details[0]->Email
        ]);

        $res->status(200)->json(['message'=>'Address Added successfully.']);

    }

    // ----------UPDATE ADDRESS----------
    public function update(Request $req, Response $res){

        Validation::check($req->body, [
            'edit_address_street_name' => ['text'],
            'edit_address_house_number' => ['integer'],
            'edit_address_postal_code' => ['postal-code'],
            'edit_address_city' => ['text', 'min:3', 'max:20'],
            'edit_address_phone' => ['phone']
        ]);

        $userId = session('userId');

        $user = new User();
        $details = $user->columns(['Email'])->where('UserId', '=', $userId)->read();

        $userAddress = new UserAddress();
        $userAddress->where('UserId', '=', $userId)->update([
            'UserId' => $userId,
            'AddressLine1' => $req->body->edit_address_street_name,
            'AddressLine2' => $req->body->edit_address_house_number,
            'City' => $req->body->edit_address_street_name,
            'PostalCode' => $req->body->edit_address_postal_code,
            'Mobile' => $req->body->edit_address_phone,
            'State' => 'Gujarat',
            'Email' => $details[0]->Email
        ]);

        $res->status(200)->json(['message'=>'Address Updated successfully.']);

    }

}