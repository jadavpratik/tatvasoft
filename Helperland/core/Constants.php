<?php

    $path1 = 'http://localhost/tatvasoft/Helperland';
    $path2 = 'http://localhost:8000';
    $path3 = '';

    define('BASE_URL', $path1);
    define('ROOT', str_replace('\core', '', __DIR__));
    define('ASSETS', str_replace('\core', '\public', __DIR__));
