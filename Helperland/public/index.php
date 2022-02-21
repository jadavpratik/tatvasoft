<?php

    // LOAD REQUIRED FILES...
    require_once __DIR__."/../core/Autoload.php";

    // LOAD ROUTES...
    require_once __DIR__."/../routes/Index.php";

    // FOLDER NAME WILL BE LOWERCASE...
    // FILE NAME WILL BE UPPERCASE...

    /*
        CSRF, 
        HEADER TOKEN, 
        /\ TRIMING IN ANY CASEES...
        : /upload/contact/attachent/
        : /upload/contact/attachment
        : upload/contact/attachment/
        : upload/contact/attachment
    */
