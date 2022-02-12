<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;


class Customer{

    public function view(Request $req, Response $res){
        $res->render('customer/index');
    }

}