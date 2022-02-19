<?php

require_once __DIR__."/Static.php";
require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/PageNotFound.php";

// ----------------------------TESTROUTES----------------------------
use core\Route;
// use core\ValidationBk;

// Route::post('/test', function($req, $res){
    
//     $validation = ValidationBk::check($req->body, [
//         'firstName'        => ['required', 'string'],
//         'lastName'         => ['required', 'text'],
//         'emailAddress'     => ['required', 'email'],
//         'phoneNumber'      => ['required', 'phone'], 
//         'password'         => ['required', 'phone'], 
//         'confirmPassword'  => ['required', 'phone'], 
//     ]);

//     $res->json($validation);

// });

// ---------------------------------------------------------------------

/*
    // CSRF, HEADER TOKEN, /\ TRIMING IN ANY CASEES...
    : /upload/contact/attachent/
    : /upload/contact/attachment
    : upload/contact/attachment/
    : upload/contact/attachment
    FOLDER NAME WILL BE LOWERCASE...
    FILE NAME WILL BE UPPERCASE...
*/

// use core\Database;
// class Test extends Database{
//     protected $table = 'test';
// }
