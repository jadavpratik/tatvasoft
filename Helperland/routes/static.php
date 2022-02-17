<?php

use core\Route;

// STATIC PAGES CONTROLLERS...
use app\controllers\static\Home;
use app\controllers\static\FAQs;
use app\controllers\static\Prices;
use app\controllers\static\Contact;
use app\controllers\static\About;
use app\controllers\static\Guarantee;


Route::get('/', [new Home(), 'view']);
Route::get('/faqs', [new FAQs(), 'view']);
Route::get('/prices', [new Prices(), 'view']);
Route::get('/contact', [new Contact(), 'view']);
Route::get('/about', [new About(), 'view']);
Route::get('/guarantee', [new Guarantee(), 'view']);

// ---------------POST-METHOD-------------------
Route::post('/contact', [new Contact(), 'submit']);
