<?php

    // DIRECTORY PATH
    $DIR_PATH = 'http://localhost/tatvasoft/helperland';
    // PORT PATH
    $PORT_PATH = "http://localhost:".$_SERVER['SERVER_PORT'];
    // BASE_URL
    $BASE_URL = ($_SERVER['SERVER_PORT']==80 && $_SERVER['HTTP_HOST']=='localhost')? $DIR_PATH : $PORT_PATH ;

    // SET THE BASE_URL
    define('BASE_URL', $BASE_URL);
    define('URL_TRIM_PART', str_replace('http://localhost', '', $DIR_PATH));
    
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
