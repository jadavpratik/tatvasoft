<?php

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/Admin.php";
require_once __DIR__."/View.php";
require_once __DIR__."/NotFound.php";

// ROUTE ISSUE FOR PARAMS ID WHEN MULTIPLE SLASH ON ROUTE AND ID IS PRESENT THEN ROUTE NOT WORK

use core\Route;
use core\Mail;
use core\Database;
use app\models\Test;

// Route::get('/test/routte/tata/bye/:id', function($req, $res){
//     echo '<pre> First Route <br>';
//     print_r($req->params);
// });

// Route::get('/test/route/tata/bye/:id', function($req, $res){
//     echo '<pre> Second Route <br>';
//     print_r($req->params);
// });
