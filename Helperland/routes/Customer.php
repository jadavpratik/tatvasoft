<?php

use core\Route;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Signup as CustomerSignup;

Route::get('/customer/signup', [new CustomerSignup(), 'view']);

