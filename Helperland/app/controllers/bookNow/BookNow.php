<?php

namespace app\controllers\bookNow;

use core\Request;
use core\Response;
use core\Validation;

use app\models\UserAddress;
use app\models\User;
use app\models\Service;
use app\models\ServiceAddress;
use app\models\ExtraService;

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
            'postal_code' => ['required','postal-code'],
            'date' => ['required'],
            'time' => ['required'],
            'duration' => ['required', 'number'],
            'extra' => ['optional', 'array'],
            'extra_time' => ['optional'],
            'comments' => ['optional'],
            'has_pets' => ['optional'],
            'sp_id' => ['optional', 'number'],
            'address' => ['required', 'object'],
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
        $sp_id = isset($req->body->sp_id)? $req->body->sp_id : null;
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
            'Status' => 0 //STATUS ZERO MEANS NEW REQUEST...
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
                $extraId = $this->setExtraServiceId($extra[$i]);
                $extra_service_obj->create([
                    'ServiceRequestId' => $serviceId,
                    'ServiceExtraId' => $extraId,
                ]);
            }    
        }
        // SERVICE POOL [SEND MAIL TO ALL SP ACCORDING TO POSTAL CODE]
        // DIRECT ASSIGNMENT OF USER...
        $res->status(201)->json(['message'=>'Service Book Successfully.', 'id'=>$serviceId]);
    }

    // SET EXTRA SERVICE ID...
    public function setExtraServiceId($extraServiceName){
        switch($extraServiceName){
            case 'Cabinet':
                return 1;
            case 'Fridge':
                return 2;
            case 'Oven':
                return 3;
            case 'Laundry':
                return 4;
            case 'Window':
                return 5;
        }
    }

}