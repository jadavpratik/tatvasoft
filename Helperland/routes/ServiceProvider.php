<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

// SERVICE PROVIDER CONTROLLERS...
use app\controllers\serviceProvider\ServiceProvider;

Route::get('/service-provider', [new Auth(), 'isServiceProvider'], [new ServiceProvider(), 'view']);
