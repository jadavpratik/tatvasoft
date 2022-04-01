<?php

use core\Route;
use core\Database;

Route::get('/test', function($req, $res){
    echo '<pre>';
    $db = new Database();
    $data = $db->query('SELECT * FROM user');
    print_r(gettype($data[0]->UserId));    
    // RANDOM STRING:bin2hex(random_bytes(16))
});

// ----------INCLUDE ALL ROUTES----------
require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/Admin.php";
require_once __DIR__."/View.php";
require_once __DIR__."/NotFound.php";

