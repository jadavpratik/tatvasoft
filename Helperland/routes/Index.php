<?php
// -----------TEMP-SESSION------------
// session('isLogged', true);
// session('userId', 1);
// session('userRole', 'customer');
// session('userName', 'Gaurav Barai');

// session('isLogged', true);
// session('userId', 11);
// session('userRole', 'servce-provider');
// session('userName', 'Pratik Jadav');

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/View.php";
require_once __DIR__."/NotFound.php";

// use core\Route;

// Route::get('/set_cookie', function(){
//     cookie('test_cookie', 'hi how are you?');
// });

// Route::get('/get_cookie', function(){
//     if(cookie('test_cookie')){
//         echo cookie('test_cookie');
//     }
//     else{
//         echo 'false';
//     }
// });

// SET TITILE OF PAGE...