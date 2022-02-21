<?php

require_once __DIR__."/Static.php";
require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/PageNotFound.php";

// ----------------------------TESTROUTES----------------------------
use core\Route;
use core\Validation;

Route::post('/test', function($req, $res){
    $validation = Validation::check($req->body, [
        'firstName'        => ['text'],
        'lastName'         => ['text'],
        'emailAddress'     => ['email'],
        'phoneNumber'      => ['phone'], 
        'password'         => ['password'], 
        'confirmPassword'  => ['confirm-password'], 
        'postalCode'       => ['postal-code'], 
        'otp'              => ['integer', 'length:4'],
        'array'            => ['array'],
        'object'           => ['object']
    ]);
    // $res->status(400)->json($validation);
});

