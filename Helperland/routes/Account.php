<?php

use core\Route;

// PROFILE-ACCOUNT CONTROLLER...
use app\controllers\profile\Account;

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/check-otp', [new Account(), 'check_otp']);
Route::patch('/set-new-password', [new Account(), 'set_new_password']);
Route::get('/logout', [new Account(), 'logout']);
