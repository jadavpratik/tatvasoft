<?php

namespace app\controllers\serviceProvider;

use core\Request;
use core\Response;

class ServiceProvider{

    public function view(Request $req, Response $res){
        $res->render('service-provider/index');
    }

}