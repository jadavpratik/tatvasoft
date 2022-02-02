<?php

    // REQUIRE CONSTANT...
    require_once __DIR__.'/Constants.php';

    // REQUIRED GLOBAL FUNCTIONS... LIKE URL, ASSETS, SESSION
    require_once ROOT.'/core/Functions.php';

    spl_autoload_register(function($class){
        // FILE NAME AND CLASS NAME MUST BE SAME OTHERWISE NOT BE LOADED...
        $class_path = ROOT.'/'.$class.'.php';
        if(file_exists($class_path)){
            require_once $class_path;
        }
    });
