<?php

use core\Route;

use app\middleware\Auth;
$isLogged = [new Auth(), 'isLogged'];

// PROFILE CONTROLLER...
use app\controllers\profile\Account;
use app\controllers\profile\MyDetails;
use app\controllers\profile\MyAddress;

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/verify-otp', [new Account(), 'verify_otp']);
Route::patch('/set-new-password', [new Account(), 'set_new_password']);
Route::get('/logout', [new Account(), 'logout']);

// -----------MY-DETAILS & MY-ADDRESS---------------

Route::patch('/my-details', $isLogged, [new MyDetails(), 'update']);

Route::post('/my-address', $isLogged, [new MyAddress(), 'add']);
Route::patch('/my-address', $isLogged, [new MyAddress(), 'update']);
Route::patch('/change-password', $isLogged, [new Account(), 'change_password']);
