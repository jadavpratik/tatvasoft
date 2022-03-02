<?php

// -----------TEMP-SESSION------------
session('isLogged', true);
session('userId', 34);
session('userRole', 'customer');
session('userName', 'Gaurav Barai');

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/View.php";


// use core\Route;
// use app\models\Service;

// Route::get('/test_api', function(){
    // $service = new Service();
// });