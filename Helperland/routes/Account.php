<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

// PROFILE-ACCOUNT CONTROLLER...
use app\controllers\profile\Account;
use app\controllers\customer\Signup as CustomerSignup;
use app\controllers\serviceProvider\Signup as ServiceProviderSignup;


Route::get('/login', [new Auth(), 'alreadyLogged'],[new Account(), 'login_view']);
Route::get('/forgot-password', [new Auth(), 'alreadyLogged'],[new Account(), 'forgot_password_view']);
Route::get('/service-provider/signup', [new Auth(), 'alreadyLogged'], [new ServiceProviderSignup(), 'view']);
Route::get('/customer/signup', [new Auth(), 'alreadyLogged'], [new CustomerSignup(), 'view']);
Route::get('/logout', [new Account(), 'logout']);

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/check-otp', [new Account(), 'check_otp']);

Route::put('/set-new-password', [new Account(), 'set_new_password']);

// PENDING....
// Route::put();
// Route::delete();
