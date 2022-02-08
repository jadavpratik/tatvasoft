<?php

use core\Route;
use core\Middleware;
use app\middleware\Auth;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Signup as CustomerSignup;

Route::get('/customer/signup', [new CustomerSignup(), 'view']);

Middleware::apply([new Auth(), 'user'], function(){

    // PROTECTED ROUTES...

});
