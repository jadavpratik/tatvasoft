<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;


class Dashboard{

    public function current_service_requests(Request $req, Response $res){
        $arr = array(['name'=>'pratikjadav',
                      'mobile'=>'787932',
                      'address'=>'fdaslk']
                      ,
                      ['name'=>'pratikjadav',
                      'mobile'=>'787932',
                      'address'=>'fdaslk']
                      ,
                      ['name'=>'pratikjadav',
                      'mobile'=>'787932',
                      'address'=>'fdaslk']
                      ,
                      ['name'=>'pratikjadav',
                      'mobile'=>'787932',
                      'address'=>'fdaslk']
                      ,
                      ['name'=>'pratikjadav',
                      'mobile'=>'787932',
                      'address'=>'fdaslk']
                      ,
                      ['name'=>'pratikjadav',
                      'mobile'=>'787932',
                      'address'=>'fdaslk']
                      ,);
        $res->status(200)->json($arr);
    }

}