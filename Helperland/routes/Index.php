<?php

// -----------TEMP-SESSION------------
// session('isLogged', true);
// session('userId', 1);
// session('userRole', 1);
// session('userName', 'Gaurav Barai');

// session('isLogged', true);
// session('userId', 9);
// session('userRole', 2);
// session('userRoleName','service-provider');
// session('userName', 'Pratik Jadav');

require_once __DIR__."/Account.php";
require_once __DIR__."/BookNow.php";
require_once __DIR__."/Contact.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/ServiceProvider.php";
require_once __DIR__."/View.php";
// require_once __DIR__."/NotFound.php";

use core\Route;
use app\models\Test;

Route::get('/test-route', function($req, $res){
    // $db = new Database();
    // $sql = "SELECT s.*, a.*, GROUP_CONCAT(e.ServiceExtraId) AS Extra 
    //         FROM servicerequest AS s 
    //         INNER JOIN servicerequestextra AS e 
    //             ON s.ServiceRequestId=e.ServiceRequestId
    //         INNER JOIN servicerequestaddress AS a 
    //             ON s.ServiceRequestId=a.ServiceRequestId
    //         GROUP BY s.ServiceRequestId";
    // $data = $db->query($sql);
    // $res->json($data);
});


