<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

// BOOKNOW CONTROLLERS...
use app\controllers\bookNow\BookNow;

// -------------SERVICE-BOOKING-ROUTES--------------------
Route::get('/book-now', [new Auth(), 'isLogged'], [new BookNow(), 'view']);
Route::get('/get-address', [new BookNow(), 'get_address']);

Route::post('/check-postal-code', [new BookNow(), 'check_postal_code']);
Route::post('/add-address', [new BookNow(), 'add_address']);
Route::post('/book-now', [new BookNow(), 'book_service']);