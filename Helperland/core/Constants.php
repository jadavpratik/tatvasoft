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
    define('DB_TYPE', $_ENV['DB_TYPE']);
    define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_NAME', $_ENV['DB_NAME']);
    define('DB_USER', $_ENV['DB_USER']);
    define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

    define('SMTP_HOST', $_ENV['SMTP_HOST']);
    define('SMTP_SECURE', $_ENV['SMTP_SECURE']);
    define('EMAIL_PORT', $_ENV['EMAIL_PORT']);
    define('EMAIL_ADDRESS', $_ENV['EMAIL_ADDRESS']);
    define('EMAIL_PASSWORD', $_ENV['EMAIL_PASSWORD']);
    define('ADMIN_EMAIL', $_ENV['ADMIN_EMAIL']);
    define('RES_WITH_MAIL', $_ENV['RES_WITH_MAIL']);
    
    // SESSION CONFIG...
    define('SESSION_PATH', __DIR__.'/../public/sessions/');
    
    // STORAGE PATH...
    define('STORAGE_PATH', __DIR__.'/../public/upload/');
