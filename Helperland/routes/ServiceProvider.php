<?php

use core\Route;

// MIDDLEWARE...
use app\middleware\Auth;

// SERVICE PROVIDER CONTROLLERS...
use app\controllers\serviceProvider\Signup as ServiceProviderSignup;
use app\controllers\serviceProvider\ServiceProvider;

Route::get('/service-provider', [new Auth(), 'isLogged'], [new ServiceProvider(), 'view']);

Route::get('/service-provider/signup', [new Auth(), 'alreadyLogged'], [new ServiceProviderSignup(), 'view']);
