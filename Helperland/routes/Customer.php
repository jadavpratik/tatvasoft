<?php

use core\Route;

use app\middleware\Auth;
$isCustomer = [new Auth(), 'isCustomer'];

use app\controllers\customer\Dashboard as CustomerDashboard;

Route::get('/customer-current-service-requests', $isCustomer, [new CustomerDashboard(), 'current_service_requests']);