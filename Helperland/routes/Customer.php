<?php

use core\Route;
use app\middleware\Auth;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Signup as CustomerSignup;
use app\controllers\customer\BookNow;

Route::get('/customer/signup', [new CustomerSignup(), 'view']);

// PROTECTED ROUTES...                        >>>>MIDDLEWARE FUNCTION<<<< 
Route::get('/book-now', [new BookNow(), 'view'], [new Auth(), 'user']);
