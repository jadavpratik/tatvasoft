<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Customer;
use app\controllers\customer\Signup as CustomerSignup;

Route::get('/customer/signup', [new Auth(), 'alreadyLogged'], [new CustomerSignup(), 'view']);
Route::get('/customer', [new Auth(), 'isLogged'], [new Customer(), 'view']);


