<?php

require_once __DIR__."/Static.php";
require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/PageNotFound.php";

// ----------------------------TESTROUTES----------------------------
use core\Route;
// use core\Validation;
use app\models\Test;

Route::get('/test', function($req, $res){
});

// TABLE TO CARD
// SESSION ON DATABASE
// JOIN TABLE

