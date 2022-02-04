<?php

    // PATH ONE WILL BE A DOCUMENT ROOT PATH + __DIR__...[PORT:80]
    $path1 = 'http://localhost/tatvasoft/Helperland';
    // PORT PATH
    $path2 = "http://localhost:".$_SERVER['SERVER_PORT'];

    define('BASE_URL', $path1);
    define('ROOT', str_replace('\core', '', __DIR__));
    define('ASSETS', str_replace('\core', '\public', __DIR__));
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'helperland');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    