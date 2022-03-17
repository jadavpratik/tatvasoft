<?php

use core\Route;

use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

use app\controllers\Customer;

Route::get('/customer-current-services', $isCustomer, [new Customer(), 'current_services']);
Route::get('/customer-service-history', $isCustomer, [new Customer(), 'service_history']);
Route::get('/customer-my-sp', $isCustomer, [new Customer(), 'my_service_provider']);

Route::post('/rate-sp/:id', $isCustomer, [new Customer(), 'rate_sp']);                        // id = serviceId
Route::patch('/cancel-service/:id', $isCustomer, [new Customer(), 'cancel_service']);         // id = serviceId
Route::patch('/reschedule-service/:id', $isCustomer, [new Customer(), 'reschedule_service']); // id = serviceId

Route::patch('/favorite/:id', $isCustomer, [new Customer(), 'add_to_favorite']);        // id = serviceProviderId
Route::patch('/unfavorite/:id', $isCustomer, [new Customer(), 'remove_from_favorite']); // id = serviceProviderId
Route::patch('/block-sp/:id', $isCustomer, [new Customer(), 'block_sp']);               // id = serviceProviderId
Route::patch('/unblock-sp/:id', $isCustomer, [new Customer(), 'unblock_sp']);           // id = serviceProviderId