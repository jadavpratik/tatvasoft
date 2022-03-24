<?php

use core\Route;

// ----------MIDDLWARE----------
use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

// ----------CONTROLLERS----------
use app\controllers\Customer;

Route::get('/customer/service/current', $isCustomer, [new Customer(), 'current_services']);
Route::get('/customer/service/history', $isCustomer, [new Customer(), 'service_history']);

Route::patch('/customer/service/cancel/:id', $isCustomer, [new Customer(), 'cancel_service']);         // id = serviceId
Route::patch('/customer/service/reschedule/:id', $isCustomer, [new Customer(), 'reschedule_service']); // id = serviceId

Route::get('/customer/sp', $isCustomer, [new Customer(), 'my_service_provider']);
Route::post('/customer/sp/rate/:id', $isCustomer, [new Customer(), 'rate_sp']);                        // id = serviceId
Route::patch('/customer/sp/favorite/:id', $isCustomer, [new Customer(), 'add_to_favorite']);        // id = serviceProviderId
Route::patch('/customer/sp/unfavorite/:id', $isCustomer, [new Customer(), 'remove_from_favorite']); // id = serviceProviderId
Route::patch('/customer/sp/block/:id', $isCustomer, [new Customer(), 'block_sp']);               // id = serviceProviderId
Route::patch('/customer/sp/unblock/:id', $isCustomer, [new Customer(), 'unblock_sp']);           // id = serviceProviderId