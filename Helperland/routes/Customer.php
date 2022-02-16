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

// SECTION - 1
Route::post('/check-postal-code', [new BookNow(), 'check_postal_code']);

// SECTION - 2
// NO ROUTES...

// SECTION - 3
Route::get('/get-address', [new BookNow(), 'get_address']);
Route::post('/add-address', [new BookNow(), 'add_address']);

// SECTION - 4 [FINAL SUBMIT]
Route::post('/book-now', [new BookNow(), 'book_service']);





