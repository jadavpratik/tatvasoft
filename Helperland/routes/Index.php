<?php

use core\Route;
use app\controllers\static\PageNotFound;

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/Static.php";

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

// Route::get('/test', function(){
//     $test = new Test();
//     $result = $test->create([
//         'name'=>'Test'
//     ]);
// });


// -----------404 MUST BE LAST-----------------
Route::get('/*', [new PageNotFound(), 'view']);
