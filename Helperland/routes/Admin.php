<?php

use core\Route;

// ----------MIDDLWARE----------
use app\middleware\Auth;
$isAdmin = [new Auth(), 'isAdmin'];

// ----------CONTROLLERS----------
use app\controllers\Admin;

Route::get('/admin/user-management', $isAdmin, [new Admin(), 'user_management']);
Route::get('/admin/service-requests', $isAdmin, [new Admin(), 'service_requests']);
Route::patch('/admin/user/active/:id', $isAdmin, [new Admin(), 'make_user_active']); // id = userId
Route::patch('/admin/user/inactive/:id', $isAdmin, [new Admin(), 'make_user_inactive']); // id = userId
Route::patch('/admin/service/reschedule/:id', $isAdmin, [new Admin(), 'reschedule_service']); // id = ServiceId
Route::patch('/admin/service/cancel/:id', $isAdmin, [new Admin(), 'cancel_service']); // id = ServiceId