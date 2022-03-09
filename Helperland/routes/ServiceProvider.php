<?php

use core\Route;
use app\middleware\Auth;
$isServiceProvider = [new Auth(), 'isServiceProvider'];

use app\controllers\serviceProvider\Dashboard as SP_Dashboard;

Route::get('/sp-new-services', $isServiceProvider, [new SP_Dashboard(), 'new_services']);
Route::get('/sp-upcoming-services', $isServiceProvider, [new SP_Dashboard(), 'upcoming_services']);
Route::get('/sp-service-history', $isServiceProvider, [new SP_Dashboard(), 'service_history']);
Route::get('/sp-my-rating', $isServiceProvider, [new SP_Dashboard(), 'my_rating']);
Route::get('/sp-my-customer', $isServiceProvider, [new SP_Dashboard(), 'my_customer']);

// Route::patch('/accept-service/:id', $isServiceProvider, [new SP_Dashboard(), 'accept_service']);
// Route::patch('/reject-service/:id', $isServiceProvider, [new SP_Dashboard(), 'reject_service']);
// Route::patch('/block-customer/:id', $isServiceProvider, [new SP_Dashboard(), 'block_customer']);
