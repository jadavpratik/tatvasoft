<?php

    // CONSTANT...
    require_once __DIR__.'/Constants.php';

    // CONFIG...
    require_once __DIR__.'/Config.php';
    
    // GLOBAL FUNCTIONS...
    require_once __DIR__.'/Functions.php';

    spl_autoload_register(function($class){
        $class = str_replace('\\', '/', $class);
        $classPath = '';
        if(str_contains($class, 'PHPMailer/PHPMailer/')){
            $classPath = __DIR__.'/../core/'.$class.'.php'; // LOAD MAIL CLASS...
        }
        else{
            $classPath = __DIR__.'/../'.$class.'.php'; // LOAD MODEL, VIEW, CONTROLLER, & CORE CLASS...
        }
        if(file_exists($classPath)){
            require_once $classPath;
        }
    });

    // FILE NAME AND CLASS NAME MUST BE SAME OTHERWISE FILE NOT BE LOADED...
    // FOLDER NAME WILL BE LOWERCASE...
    // FILE NAME WILL BE UPPERCASE...
