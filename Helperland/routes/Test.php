<?php

use core\Route;
use core\Database;
use app\services\Functions;

Route::get('/test/headers', function($req, $res){
    echo '<pre>';
    print_r(getallheaders());
});

Route::get('/test/page', function($req, $res){
    $res->render('/test');
});