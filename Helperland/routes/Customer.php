<?php

use core\Route;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Signup as CustomerSignup;

Route::get('/customer/signup', [new CustomerSingup(), 'view']);
Route::post('/customer/signup', [new CustomerSignup(), 'submit']);

// Middleware::apply('auth', function(){
// 	// ROUTES...
// });