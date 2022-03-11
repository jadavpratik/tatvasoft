<?php

use core\Route;
use app\middleware\Auth;
$isServiceProvider = [new Auth(), 'isServiceProvider'];

use app\controllers\serviceProvider\Dashboard as ServiceProviderDashboard;

Route::get('/sp-new-services', $isServiceProvider, [new ServiceProviderDashboard(), 'new_services']);
Route::get('/sp-upcoming-services', $isServiceProvider, [new ServiceProviderDashboard(), 'upcoming_services']);
Route::get('/sp-service-history', $isServiceProvider, [new ServiceProviderDashboard(), 'service_history']);
Route::get('/sp-my-rating', $isServiceProvider, [new ServiceProviderDashboard(), 'my_rating']);
Route::get('/sp-my-customer', $isServiceProvider, [new ServiceProviderDashboard(), 'my_customer']);

Route::patch('/accept-service/:id', $isServiceProvider, [new ServiceProviderDashboard(), 'accept_service']);
Route::patch('/reject-service/:id', $isServiceProvider, [new ServiceProviderDashboard(), 'reject_service']);
Route::patch('/complete-service/:id', $isServiceProvider, [new ServiceProviderDashboard(), 'complete_service']);
Route::patch('/block-customer/:id', $isServiceProvider, [new ServiceProviderDashboard(), 'block_customer']);
Route::patch('/unblock-customer/:id', $isServiceProvider, [new ServiceProviderDashboard(), 'unblock_customer']);
