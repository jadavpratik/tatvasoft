<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Validation;
use core\Database;

use app\models\UserAddress;
use app\models\User;
use app\models\Service;
use app\models\ServiceAddress;
use app\models\ExtraService;
use app\models\Favorite;

class BookNow{

    // CHECK POSTAL CODE 
    public function check_postal_code(Request $req, Response $res){

        Validation::check($req->body, [
            'postal_code' => ['postal-code']
        ]);

        $user = new User();
        $where = " ZipCode = {$req->body->postal_code} AND RoleId = 2";
        if($user->where($where)->exists()){
            $res->status(200)->json(['message'=>'User Availabe']);
        }
        else{
            $res->status(400)->json(['message'=>'We are not providing service in this area!']);
        }    

    }

    // GET CUSTOMER ADDRESS...
    public function get_address(Request $req, Response $res){
        $userAddress = new UserAddress();
        $result = $userAddress->where('UserId', '=', session('userId'))->read();
        $res->status(200)->json(['address'=>$result]);
    }

    // ADD ADDRESS...
    public function add_address(Request $req, Response $res){
        Validation::check($req->body, [
            'street_name' => ['text'],
            'house_number' => ['required'],
            'postal_code' => ['postal-code'], 
            'city' => ['text'],
            'phone' => ['phone', 'length:10']
        ]);
        $user = new User();
        $data = $user->columns(['Email'])->where('UserId', '=', session('userId'))->read();
        $userAddress = new UserAddress();
        $userAddress->create([
            'UserId' => session('userId'), 
            'AddressLine1' => $req->body->street_name,
            'AddressLine2' => $req->body->house_number,
            'City' => $req->body->city,
            'State' => 'Gujarat',
            'PostalCode' => $req->body->postal_code,
            'Email' => $data[0]->Email,
            'Mobile' => $req->body->phone,
        ]);
        $res->status(201)->json(['message'=>'Address Add Successfully.']);
    }

    // BOOK SERVICE...
    public function book_service(Request $req, Response $res){

        Validation::check($req->body, [
            'postal_code' => ['postal-code'],
            'date' => ['required'],
            'time' => ['required'],
            'duration' => ['number'],
            'extra' => ['optional'],
            'extra_time' => ['optional'],
            'comments' => ['optional'],
            'has_pets' => ['optional'],
            'sp_id' => ['optional'],
            'address' => ['object'],
        ]);

        // INITIALIZE REQUIRED VARIABLE...
        $service = new Service();
        $service_address = new ServiceAddress();

        $user_id = session('userId');
        $postal_code = $req->body->postal_code;
        $date = date('Y-m-d H:i:s', strtotime($req->body->date.' '.$req->body->time));
        $duration = $req->body->duration;
        // OPTIONAL PARAMERTERS...
        $extra =  isset($req->body->extra)? $req->body->extra : [];
        $extra_time = isset($req->body->extra_time)? $req->body->extra_time : null;
        $comments = isset($req->body->comments)? $req->body->comments : null;
        $has_pets = (isset($req->body->has_pets) && $req->body->has_pets==true)? 1 : null;
        $sp_id = null;
        if(isset($req->body->sp_id)){
            if($req->body->sp_id!=null && $req->body->sp_id!=''){
                $sp_id = $req->body->sp_id;
            }
            else{
                $sp_id = null;
            }
        }
        $hourly_rate = 70;
        $total_cost = $hourly_rate*3 + ($hourly_rate/2)*count($extra);
        // ADD SERVICE_REQUEST IN DATABASE TABLE...
        $serviceId = $service->create([
            'UserId' => $user_id,
            'ServiceStartDate' => $date,
            'ZipCode' => $postal_code,
            'ServiceHourlyRate' => $hourly_rate,
            'ServiceHours' => $duration,
            'ExtraHours' => $extra_time,
            'SubTotal' => $total_cost,
            'TotalCost' => $total_cost,
            'Comments' => $comments,
            'ServiceProviderId' => $sp_id,
            'HasPets' => $has_pets,
            'Status' => $sp_id!=null? 1 : 0, //STATUS ZERO MEANS NEW REQUEST...
            'SPAcceptedDate' => $sp_id!=null? date('Y-m-d H:i:s') : null,
            'CreatedDate' => date('Y-m-d H:i:s'),
            'ModifiedDate' => date('Y-m-d H:i:s')
        ]);

        // ADD SERVICE_REQUEST_ADDRESS IN DATABASE TABLE...
        $service_address->create([
            'ServiceRequestId' => $serviceId,
            'AddressLine1' => $req->body->address->AddressLine1,
            'AddressLine2' => $req->body->address->AddressLine2,
            'City' => $req->body->address->City,
            'State' => $req->body->address->State,
            'PostalCode' => $req->body->address->PostalCode,
            'Mobile' => $req->body->address->Mobile,
            'Email' => $req->body->address->Email,
        ]);

        // ADD EXTRA SERVICES IN DATABASE IF USER WANT'S...
        if(count($extra)>0){
            $extra_service_obj = new ExtraService();
            for($i=0; $i<count($extra); $i++){
                $extra_service_obj->create([
                    'ServiceRequestId' => $serviceId,
                    'ServiceExtraId' => (int) $extra[$i],
                ]);
            }    
        }
        // SERVICE POOL [SEND MAIL TO ALL SP ACCORDING TO POSTAL CODE]
        // DIRECT ASSIGNMENT OF USER BY SP ID...
        $res->status(201)->json(['message'=>'Service Book Successfully.', 'id'=>$serviceId]);
    }

    // GET FAVORITE SP...
    public function get_favorite_sp(Request $req, Response $res){
        $customerId = session('userId');
        $db = new Database();
        $sql = "SELECT u.* FROM user as u
                INNER JOIN favoriteandblocked as f 
                ON u.UserId = f.TargetUserId 
                WHERE f.UserId = {$customerId} AND f.IsFavorite=1";
        $data = $db->query($sql);
        $data = array_filter($data, function($i){
            unset($i->Password);
            return $i;
        });
        $res->status(200)->json($data);
        // $favorite = new Favorite();
        // $user = new User();
        // $data = $favorite->where('UserId', '=', $customerId)->read();
        // $favoriteSP = [];
        // for($i=0; $i<count($data); $i++){
        //     if($data[$i]->IsFavorite==1){
        //         $spId = $data[$i]->TargetUserId;
        //         $spData = $user->where('UserId', '=', $spId)->read();
        //         $favoriteSP[] = $spData[0];
        //     }
        // }
        // $res->status(200)->json($favoriteSP);
    }

}