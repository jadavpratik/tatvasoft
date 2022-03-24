<?php

use core\Route;

// ----------MIDDLEWARE----------
use app\middleware\Auth;
$isLogged = [new Auth(), 'isLogged'];

// ----------CONTROLLERS----------
use app\controllers\Account;
use app\controllers\MyDetails;
use app\controllers\MyAddress;

// ----------MY-ACCOUNT----------
Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/verify-otp', [new Account(), 'verify_otp']);
Route::patch('/set-new-password', [new Account(), 'set_new_password']);
Route::patch('/change-password', $isLogged, [new Account(), 'change_password']);
Route::get('/logout', [new Account(), 'logout']);

// ----------MY-DETAILS----------
Route::get('/user/details', $isLogged, [new MyDetails(), 'get_details']);
Route::patch('/user/details', $isLogged, [new MyDetails(), 'update_details']);

// ----------MY-ADDRESS----------
Route::get('/user/address', $isLogged, [new MyAddress(), 'get_all_address']);
Route::get('/user/address/:id', $isLogged, [new MyAddress(), 'get_address']); // id = addressId
Route::post('/user/address', $isLogged, [new MyAddress(), 'add_address']);
Route::patch('/user/address/:id', $isLogged, [new MyAddress(), 'update_address']); // id = addressId
Route::delete('/user/address/:id', $isLogged, [new MyAddress(), 'delete_address']); // id = addressId
