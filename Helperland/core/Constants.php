<?php

    // LOCAL ROOT PATH
    $path1 = 'http://localhost/tatvasoft/Helperland';
    // ROOT PATH
    $path2 = 'http://localhost:8000';
    // DEPLOY PATH
    $path3 = '';

    define('BASE_URL', $path2);
    define('ROOT', str_replace('\core', '', __DIR__));
    define('ASSETS', str_replace('\core', '\public', __DIR__));
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'helperland');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    