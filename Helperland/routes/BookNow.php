<?php

use core\Route;

// ----------MIDDLEWARE----------
use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

// ----------BOOKNOW CONTROLLERS----------
use app\controllers\BookNow;

// ----------SERVICE-BOOKING-ACTION-ROUTES----------
Route::post('/book-service/check-postal-code', $isCustomer, [new BookNow(), 'check_postal_code']);
Route::get('/book-service/customer/address', $isCustomer, [new BookNow(), 'get_address']);
Route::post('/book-service/customer/address', $isCustomer, [new BookNow(), 'add_address']);
Route::get('/book-service/customer/favorite-sp', $isCustomer, [new BookNow(), 'get_favorite_sp']);
Route::post('/book-service', $isCustomer, [new BookNow(), 'book_service']);