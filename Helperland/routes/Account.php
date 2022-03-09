<?php

use core\Route;

use app\middleware\Auth;
$isLogged = [new Auth(), 'isLogged'];

// PROFILE CONTROLLER...
use app\controllers\profile\Account;
use app\controllers\profile\MyDetails;
use app\controllers\profile\MyAddress;

// -----------MY-ACCOUNT---------------
Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);
Route::post('/forgot-password', [new Account(), 'forgot_password']);
Route::post('/verify-otp', [new Account(), 'verify_otp']);
Route::patch('/set-new-password', [new Account(), 'set_new_password']);
Route::patch('/change-password', $isLogged, [new Account(), 'change_password']);
Route::get('/logout', $isLogged, [new Account(), 'logout']);

// -----------MY-DETAILS---------------
Route::get('/my-details', $isLogged, [new MyDetails(), 'get_details']);
Route::patch('/my-details', $isLogged, [new MyDetails(), 'update_details']);

// -----------MY-ADDRESS---------------
Route::get('/my-address', $isLogged, [new MyAddress(), 'get_all_address']);
Route::get('/my-address/:id', $isLogged, [new MyAddress(), 'get_address']); // id = addressId
Route::post('/my-address', $isLogged, [new MyAddress(), 'add_address']);
Route::patch('/my-address/:id', $isLogged, [new MyAddress(), 'update_address']); // id = addressId
Route::delete('/my-address/:id', $isLogged, [new MyAddress(), 'delete_address']); // id = addressId
