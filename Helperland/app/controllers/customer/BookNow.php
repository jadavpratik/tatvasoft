<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;


class BookNow{

    public function view(Request $req, Response $res){
        $res->render('customer/book-now');
    }

}