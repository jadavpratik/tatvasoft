<?php

use core\Route;
use app\middleware\Auth;
$isServiceProvider = [new Auth(), 'isServiceProvider'];

use app\controllers\ServiceProvider;

Route::get('/sp-new-services', $isServiceProvider, [new ServiceProvider(), 'new_services']);
Route::get('/sp-upcoming-services', $isServiceProvider, [new ServiceProvider(), 'upcoming_services']);
Route::get('/sp-service-history', $isServiceProvider, [new ServiceProvider(), 'service_history']);
Route::get('/sp-my-rating', $isServiceProvider, [new ServiceProvider(), 'my_rating']);
Route::get('/sp-my-customer', $isServiceProvider, [new ServiceProvider(), 'my_customer']);

Route::patch('/accept-service/:id', $isServiceProvider, [new ServiceProvider(), 'accept_service']);     // id = serviceId
Route::patch('/reject-service/:id', $isServiceProvider, [new ServiceProvider(), 'reject_service']);     // id = serviceId
Route::patch('/complete-service/:id', $isServiceProvider, [new ServiceProvider(), 'complete_service']); // id = serviceId

Route::patch('/block-customer/:id', $isServiceProvider, [new ServiceProvider(), 'block_customer']);     // id = customerId
Route::patch('/unblock-customer/:id', $isServiceProvider, [new ServiceProvider(), 'unblock_customer']); // id = customerId
