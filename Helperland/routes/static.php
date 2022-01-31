<?php

use core\Route;

// STATIC PAGES CONTROLLERS...
use app\controllers\static\Home;
use app\controllers\static\FAQs;
use app\controllers\static\Prices;
use app\controllers\static\Contact;
use app\controllers\static\About;
use app\controllers\Test;
use app\controllers\PageNotFound;

Route::get('/', [new Home(), 'view']);
Route::get('/faqs', [new FAQs(), 'view']);
Route::get('/prices', [new Prices(), 'view']);
Route::get('/contact', [new Contact(), 'view']);
Route::get('/about', [new About(), 'view']);

// ---------------POST_METHOD-------------------
Route::post('/contact', [new Contact(), 'submit']);

// -----------THIS METHOD WILL BE LAST-----------------
Route::get('/*', [new PageNotFound(), 'view']);



// CHANGES IN SOME HTML PAGES ACCORDING TO SITE AND SRS,
// CONTACT US HTML,
// DATABASE JOIN,
// CSRF,
// MIDDLEWARE,
// CHECK METHOD TYPE [POST, GET, PUT, DELETE],
// FILE UPLOAD,
// GURANTEE PAGE,
// HEADER CONTENT TYPE,
// AJAX,
// SESSION OR COOKIE, JWT ETC...