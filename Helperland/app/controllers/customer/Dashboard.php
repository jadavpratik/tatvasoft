<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;


class Dashboard{

    public function current_service_requests(Request $req, Response $res){
        $res->status(200)->json([['message'=>'No Data Available']]);
    }

}