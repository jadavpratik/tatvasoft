<?php

use core\Route;

use app\controllers\contact\Contact;


Route::post('/contact', [new Contact(), 'submit']);
