<?php

use core\Route;
use app\controllers\static\PageNotFound;

// -----------404 MUST BE LAST-----------------
Route::get('/*', [new PageNotFound(), 'view']);
