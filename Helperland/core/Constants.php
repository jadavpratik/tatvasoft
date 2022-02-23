<?php

    // DIRECTORY PATH
    $path1 = 'http://localhost/tatvasoft/helperland';
    // PORT PATH
    $path2 = "http://localhost:".$_SERVER['SERVER_PORT'];

    // SET THE BASE_URL, ROOT_PATH...
    define('BASE_URL', $path1);
    define('URL_TRIM_PART', str_replace('http://localhost', '', $path1));
    
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
    
    // SESSION CONFIG...
    define('SESSION_PATH', __DIR__.'/../public/sessions/');
    
    // STORAGE PATH...
    define('STORAGE_PATH', __DIR__.'/../public/upload/');
