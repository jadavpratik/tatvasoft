<?php

use core\Route;

// ----------CONTROLLERS----------
use app\controllers\View;

// ----------LAST-METHOD----------
Route::get('/*', [new View(), 'not_found_page']);
Route::post('/*', [new View(), 'not_found_json']);
Route::put('/*', [new View(), 'not_found_json']);
Route::delete('/*', [new View(), 'not_found_json']);
Route::patch('/*', [new View(), 'not_found_json']);