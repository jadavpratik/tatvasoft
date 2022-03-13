<?php

use core\Route;

use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

use app\controllers\CustomerDashboard;

Route::get('/customer-current-services', $isCustomer, [new CustomerDashboard(), 'current_services']);
Route::get('/customer-service-history', $isCustomer, [new CustomerDashboard(), 'service_history']);
Route::get('/customer-my-sp', $isCustomer, [new CustomerDashboard(), 'my_service_provider']);

Route::post('/rate-sp/:id', $isCustomer, [new CustomerDashboard(), 'rate_sp']);                        // id = serviceId
Route::patch('/cancel-service/:id', $isCustomer, [new CustomerDashboard(), 'cancel_service']);         // id = serviceId
Route::patch('/reschedule-service/:id', $isCustomer, [new CustomerDashboard(), 'reschedule_service']); // id = serviceId

Route::patch('/favorite/:id', $isCustomer, [new CustomerDashboard(), 'add_to_favorite']);        // id = serviceProviderId
Route::patch('/unfavorite/:id', $isCustomer, [new CustomerDashboard(), 'remove_from_favorite']); // id = serviceProviderId
Route::patch('/block-sp/:id', $isCustomer, [new CustomerDashboard(), 'block_sp']);               // id = serviceProviderId
Route::patch('/unblock-sp/:id', $isCustomer, [new CustomerDashboard(), 'unblock_sp']);           // id = serviceProviderId