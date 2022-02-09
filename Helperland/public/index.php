<?php

    // LOAD REQUIRED FILES...
    require_once __DIR__."/../core/autoload.php";

    // LOAD ROUTES...
    require_once __DIR__."/../routes/Account.php";
    require_once __DIR__."/../routes/Customer.php";
    require_once __DIR__."/../routes/ServiceProvider.php";
    require_once __DIR__."/../routes/Static.php";
    // THE FILE WHO CONTAIN 404 PAGE ROUTE, THAT FILE WE LOADED LAST


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
    // HEADER CONTENT TYPE,
