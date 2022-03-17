<?php

use core\Route;

use app\middleware\Auth;
use app\controllers\Admin;
$isAdmin =  function(){
    return true;
};//[new Auth(), 'isAdmin'];

Route::get('/user-management', $isAdmin, [new Admin(), 'user_management']);
Route::get('/service-requests', $isAdmin, [new Admin(), 'service_requests']);