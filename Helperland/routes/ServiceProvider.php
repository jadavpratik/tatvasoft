<?php

use core\Route;

// ----------MIDDLEWARE----------
use app\middleware\Auth;
$isServiceProvider = [new Auth(), 'isServiceProvider'];

// ----------CONTROLLERS----------
use app\controllers\ServiceProvider;

Route::get('/service-provider/service/new', $isServiceProvider, [new ServiceProvider(), 'new_services']);
Route::get('/service-provider/service/upcoming', $isServiceProvider, [new ServiceProvider(), 'upcoming_services']);
Route::get('/service-provider/service/history', $isServiceProvider, [new ServiceProvider(), 'service_history']);
Route::get('/service-provider/rating-and-review', $isServiceProvider, [new ServiceProvider(), 'my_rating']);
Route::get('/service-provider/service/schedule', $isServiceProvider, [new ServiceProvider(), 'service_schedule']);


Route::patch('/service-provider/service/accept/:id', $isServiceProvider, [new ServiceProvider(), 'accept_service']);     // id = serviceId
Route::patch('/service-provider/service/reject/:id', $isServiceProvider, [new ServiceProvider(), 'reject_service']);     // id = serviceId
Route::patch('/service-provider/service/complete/:id', $isServiceProvider, [new ServiceProvider(), 'complete_service']); // id = serviceId

Route::get('/service-provider/customer', $isServiceProvider, [new ServiceProvider(), 'my_customer']);
Route::patch('/service-provider/customer/block/:id', $isServiceProvider, [new ServiceProvider(), 'block_customer']);     // id = customerId
Route::patch('/service-provider/customer/unblock/:id', $isServiceProvider, [new ServiceProvider(), 'unblock_customer']); // id = customerId
