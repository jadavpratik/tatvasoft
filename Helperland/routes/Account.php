<?php

use core\Route;

// PROFILE-ACCOUNT CONTROLLER...
use app\controllers\profile\Account;

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);

