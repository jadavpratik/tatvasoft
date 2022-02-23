<?php

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/View.php";

// ----------------------------TESTROUTES----------------------------
// TABLE TO CARD
// SESSION ON DATABASE
// JOIN TABLE
use core\Route;

Route::get('/test', function($req, $res){
    // $date = date('Y-m-d');
    // $time = date('H:i:s', time());
    // $string = strtotime($date.' '.$time);
    // $date = date('Y-m-d H:i:s', $string);
    // echo $date;
});
