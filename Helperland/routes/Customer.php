<?php

use core\Route;
use core\Middleware;
use app\middleware\Auth;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Signup as CustomerSignup;
use app\controllers\customer\BookNow;

Route::get('/customer/signup', [new CustomerSignup(), 'view']);
Route::get('/book-now', [new BookNow(), 'view']);


Middleware::apply([new Auth(), 'user'], function(){

    // PROTECTED ROUTES...

});
