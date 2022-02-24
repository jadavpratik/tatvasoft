<?php

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/View.php";

// ----------------------------TESTROUTES----------------------------
// TABLE TO CARD
// SESSION ON DATABASE
// JOIN TABLE
// use core\Route;
// use core\Database;

// -----------------------TEST-------------------------
// Route::get('/test', function($req, $res){
//     $res->render('Test');
// });

// Route::get('/data', function($req, $res){
//     $conn = new Database();
//     if(!isset($conn->error)){
//         $data = $conn->table('test')->read();
//         $res->status(200)->json($data);
//     }
//     else{
//         $res->status(500)->json(['error'=>$conn->error]);    
//     }
// });
