<?php

use core\Route;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\profile\Account;

Route::post('/signup', [new Account(), 'signup']);
Route::post('/login', [new Account(), 'login']);

