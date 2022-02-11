<?php

    // REQUIRE CONSTANT...
    require_once __DIR__.'/Constants.php';

    // REQUIRED GLOBAL FUNCTIONS... LIKE URL, ASSETS, SESSION
    require_once ROOT.'/core/Functions.php';

    spl_autoload_register(function($class){
        // THIS IS ONLY FOR PHPMailer CLASS...
        $mail1 = 'PHPMailer\PHPMailer\PHPMailer';
        $mail2 = 'PHPMailer\PHPMailer\SMTP';
        $mail3 = 'PHPMailer\PHPMailer\Exception';

        if($class!=$mail1 && $class!=$mail2 && $class!=$mail3){
            $class_path = ROOT.'/'.$class.'.php';
            // FILE NAME AND CLASS NAME MUST BE SAME OTHERWISE FILE NOT BE LOADED...
            if(file_exists($class_path)){
                require_once $class_path;
            }
        }

    });
