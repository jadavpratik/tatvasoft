<?php

namespace app\controllers;

use core\Request;
use core\Response;

use app\models\User;

class Admin{

    // ----------USER-MANAGEMENT----------
    public function user_management(Request $req, Response $res){
        $user = new User();
        $data = $user->read();
        foreach($data as $key){
            // REMOVE PASSWORD FIELD
            $key->CreatedDate = date('d/m/Y', strtotime($key->CreatedDate));
            unset($key->Password);
        }
        $res->json($data);
    }


}