<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

$alreadyLogged = [new Auth(), 'alreadyLogged'];
$isCustomer = [new Auth(), 'isCustomer'];
$isServiceProvider = [new Auth(), 'isServiceProvider'];

// CONTROLLERS...
use app\controllers\View;

// ----------STATIC-PAGES----------
Route::get('/', [new View(), 'home']);
Route::get('/faqs', [new View(), 'faqs']);
Route::get('/prices', [new View(), 'prices']);
Route::get('/contact', [new View(), 'contact']);
Route::get('/about', [new View(), 'about']);
Route::get('/guarantee', [new View(), 'guarantee']);

// ----------COMPONENTS----------
Route::get('/login', $alreadyLogged,[new View(), 'login']);
Route::get('/forgot-password', $alreadyLogged, [new View(), 'forgot_password']);

// ----------CUSTOMER----------
Route::get('/book-now', $isCustomer, [new View(), 'booknow']);
Route::get('/customer/signup', $alreadyLogged, [new View(), 'customer_signup']);
Route::get('/customer/dashboard/', $isCustomer, [new View(), 'customer_dashboard']);

// ----------SERVICE-PROVDER----------
Route::get('/service-provider/signup/', $alreadyLogged, [new View(), 'sp_signup']);
Route::get('/service-provider/dashboard/', $isServiceProvider, [new View(), 'sp_dashboard']);

