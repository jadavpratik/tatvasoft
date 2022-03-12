<?php

use core\Route;

// MIDDLEWARE....
use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

// BOOKNOW CONTROLLERS...
use app\controllers\BookNow;

// -------------SERVICE-BOOKING-ACTION-ROUTES--------------------
Route::get('/get-customer-address', $isCustomer, [new BookNow(), 'get_address']);
Route::post('/check-postal-code', $isCustomer, [new BookNow(), 'check_postal_code']);
Route::post('/add-customer-address', $isCustomer, [new BookNow(), 'add_address']);
Route::post('/book-now', $isCustomer, [new BookNow(), 'book_service']);