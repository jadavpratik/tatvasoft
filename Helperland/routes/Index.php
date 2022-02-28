<?php

session('isLogged', true);
session('userId', 34);
session('userRole', 'customer');
session('userName', 'Gaurav Barai');

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/View.php";

// ----------------------------TESTROUTES----------------------------
// use core\Route;
// use core\Database;

// -----------------------TEST-------------------------
// Route::get('/test', function($req, $res){
//     $res->render('static/test');
// });

// Route::get('/data', function($req, $res){
//     $conn = new Database();
//     $data = $conn->table('test')->read();
//     $res->status(200)->json($data);
// });
