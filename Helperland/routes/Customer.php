<?php

use core\Route;


// MIDDLEWARE...
use app\middleware\Auth;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Customer;
use app\controllers\customer\Signup as CustomerSignup;
use app\controllers\customer\BookNow;

Route::get('/customer/signup', [new Auth(), 'alreadyLogged'], [new CustomerSignup(), 'view']);

// PROTECTED ROUTES...
Route::get('/customer', [new Auth(), 'isLogged'], [new Customer(), 'view']);
Route::get('/book-now', [new Auth(), 'isLogged'], [new BookNow(), 'view']);

