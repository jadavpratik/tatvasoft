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


// ----------TEMP-TEST-SESSION-----------
session('isLogged', true);
session('userId', 34);
session('userName', 'Gaurav Barai');

// -------------SERVICE-BOOKING-ROUTES--------------------
Route::get('/book-now', [new Auth(), 'isLogged'], [new BookNow(), 'view']);
Route::post('/check-postal-code', [new BookNow(), 'check_postal_code']);
Route::get('/get-address/:id', [new BookNow(), 'get_address']);
Route::post('/add-address/:id', [new BookNow(), 'add_address']);





