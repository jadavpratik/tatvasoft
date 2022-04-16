<?php

use core\Route;
use core\Database;
use app\services\Functions;

Route::get('/test/api', function($req, $res){
    $res->json(getallheaders());
});

Route::get('/test/page', function($req, $res){
    $res->render('/test');
});