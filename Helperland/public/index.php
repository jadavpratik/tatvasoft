<?php

    // LOAD REQUIRED FILES...
    require_once "../core/autoload.php";

    // LOAD ROUTES...
    require_once "../routes/Static.php";
    require_once "../routes/Customer.php";
    require_once "../routes/ServiceProvider.php";
    
// -------------------------------------------------
    // REMOVE OR TRIM /\ FROM ASSETS, URL, FILEUPLOAD PATH MEANS ALL PATH...
    // WHAT EVENT PATH WE WRITE IT'S AUTOMETIC SET... LIKE...
    // this below ALL PATH WILL BE ACCESSABLIE...
    // : /upload/contact/attachent/
    // : /upload/contact/attachment
    // : upload/contact/attachment/
    // : upload/contact/attachment
    // FOLDER NAME WILL BE LOWERCASE...
    // FILE NAME WILL BE UPPERCASE...


    // IF FILE EXIST THEN REQUIRE IT...

    // DATABASE JOIN,
    // CSRF,
    // MIDDLEWARE,
    // GURANTEE PAGE,
    // HEADER CONTENT TYPE,
