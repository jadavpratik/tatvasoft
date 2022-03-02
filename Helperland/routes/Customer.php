<?php

use core\Route;

use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

use app\controllers\customer\Dashboard as CustomerDashboard;

Route::get('/customer-current-services', $isCustomer, [new CustomerDashboard(), 'current_services']);
Route::patch('/cancel-service/:id', $isCustomer, [new CustomerDashboard(), 'cancel_service']);
Route::patch('/reschedule-service/:id', $isCustomer, [new CustomerDashboard(), 'reschedule_service']);
Route::get('/customer-all-services', $isCustomer, [new CustomerDashboard(), 'all_services']);

// FAVOURITE
// UNFAVOURITE
// BLOCK
// UNBLOCK
// RATE SP

