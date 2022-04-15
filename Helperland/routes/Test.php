<?php

use core\Route;
use core\Database;
use app\services\Functions;


Route::get('/test', function($req, $res){
    echo '<pre>';
    print_r(getallheaders());
});