<?php

    // CONSTANT...
    require_once __DIR__.'/Constants.php';

    // CONFIG...
    require_once __DIR__.'/Config.php';
    
    // GLOBAL FUNCTIONS...
    require_once __DIR__.'/Functions.php';

    spl_autoload_register(function($class){

        // NOT TO LOAD PHPMailer Class Here...
        $PHPMailer = 'PHPMailer\PHPMailer\PHPMailer';
        $SMTP      = 'PHPMailer\PHPMailer\SMTP';
        $Exception = 'PHPMailer\PHPMailer\Exception';

        if($class!=$PHPMailer  &&  $class!=$SMTP  &&  $class!=$Exception){
            $class = str_replace('\\', '/', $class);
            $class_path = __DIR__.'/../'.$class.'.php';
            // FILE NAME AND CLASS NAME MUST BE SAME OTHERWISE FILE NOT BE LOADED...
            if(file_exists($class_path)){
                require_once $class_path;
            }
        }

    });
