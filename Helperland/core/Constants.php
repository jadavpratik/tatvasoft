<?php

    // DIRECTORY PATH... (AUTO SELECT DIRECTORY PATH FIXING PENDING...)
    $path1 = 'http://localhost/tatvasoft/Helperland';
    // PORT PATH
    $path2 = "http://localhost:".$_SERVER['SERVER_PORT'];

    // SET THE BASE_URL, ROOT_PATH...
    define('BASE_URL', $path1);
    define('ROOT', str_replace('\core', '', __DIR__));
    
    // CONFIG OF DATABASE...
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'helperland');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    
    // CONFIG OF MAIL...
    define('SMTP_HOST', 'smtp.gmail.com');
    define('EMAIL_ADDRESS', '');
    define('EMAIL_PASSWORD', '');
    