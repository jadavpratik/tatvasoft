<?php

use core\Route;

// SERVICE PROVIDER CONTROLLERS...
use app\controllers\serviceProvider\Signup as ServiceProviderSignup;

Route::get('/service-provider/signup', [new ServiceProviderSignup(), 'view']);
