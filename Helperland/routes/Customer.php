<?php

use core\Route;

use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

use app\controllers\customer\Dashboard as CustomerDashboard;

Route::get('/customer-current-services', $isCustomer, [new CustomerDashboard(), 'current_services']);
Route::get('/customer-all-services', $isCustomer, [new CustomerDashboard(), 'all_services']);
Route::get('/customer-favorite-sp-list', $isCustomer, [new CustomerDashboard(), 'customer_sp_list']);
Route::post('/rate-service-provider/:id', $isCustomer, [new CustomerDashboard(), 'rate_service_provider']);

Route::patch('/cancel-service/:id', $isCustomer, [new CustomerDashboard(), 'cancel_service']);
Route::patch('/reschedule-service/:id', $isCustomer, [new CustomerDashboard(), 'reschedule_service']);
Route::patch('/add-sp-to-favorite/:id', $isCustomer, [new CustomerDashboard(), 'add_to_favorite']);
Route::patch('/remove-sp-from-favorite/:id', $isCustomer, [new CustomerDashboard(), 'remove_from_favorite']);
Route::patch('/block-sp/:id', $isCustomer, [new CustomerDashboard(), 'block_sp']);
Route::patch('/unblock-sp/:id', $isCustomer, [new CustomerDashboard(), 'unblock_sp']);