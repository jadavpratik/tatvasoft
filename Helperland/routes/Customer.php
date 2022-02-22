<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

// CUSTOMER PAGES CONTROLLERS...
use app\controllers\customer\Customer;

Route::get('/customer', [new Auth(), 'isCustomer'], [new Customer(), 'view']);


