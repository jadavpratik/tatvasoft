<?php

use core\Route;

use app\controllers\Contact;


Route::post('/contact', [new Contact(), 'submit']);
