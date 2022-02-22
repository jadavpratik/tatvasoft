<?php

require_once __DIR__."/Static.php";
require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/PageNotFound.php";

// TABLEE TO CARD
// SESSION ON DATABASE
// JOIN TABLE
// <script>alert('hachek');</script>

// ----------------------------TESTROUTES----------------------------
// use core\Route;
// use core\Validation;

// Route::get('/test', function($req, $res){
//     if(""){
//         echo 'hello';
    // a&lt;script&gt;alert(&#039;hacked&#039;);&lt;/script&gt;
//     }
//     else{
//         echo 'you win';
//     }    
    // // check htmlspecialchars();
    // $validation = Validation::check($req->body, [
    //     'firstName'        => ['text'],
    //     'lastName'         => ['text'],
    //     'emailAddress'     => ['email'],
    //     'phoneNumber'      => ['phone'], 
    //     'password'         => ['password'], 
    //     'confirmPassword'  => ['confirm-password'], 
    //     'postalCode'       => ['postal-code'], 
    //     'otp'              => ['integer', 'length:4'],
    //     'array'            => ['array'],
    //     'object'           => ['object']
    // ]);
    // $res->status(400)->json($validation);
// });

