<?php

namespace app\controllers\bookNow;

use core\Request;
use core\Response;
use core\Validation;


use app\models\PostalCode;
use app\models\UserAddress;
use app\models\User;
use app\models\Service;
use app\models\ServiceAddress;
use app\models\ExtraService;

class BookNow{


    public function view(Request $req, Response $res){
        $res->render('book-now/index');
    }

    // CHECK POSTAL CODE 
    public function check_postal_code(Request $req, Response $res){
        $validation = Validation::check($req->body, [
            'postal_code' => ['postal-code']
        ]);

        if($validation==1){
            $obj = new User();
            $where = " ZipCode = {$req->body->postal_code} AND RoleId = 2";
            $result = $obj->where($where)->exists();
            if($result){
                $res->status(200)->json(['message'=>'User Availabe']);
            }
            else{
                $res->status(400)->json(['message'=>'We are not providing service in this area!']);
            }
        }
        else{
            $res->status(400)->json($validation);
        }

    }

    // GET LOGGED USER ADDRESS...
    public function get_address(Request $req, Response $res){
        if(session('userId')){
            $userAddress = new UserAddress();
            $result = $userAddress->where('UserId', '=', session('userId'))->read();
            if(gettype($result)=='array'){
                $res->status(200)->json(['address'=>$result]);
            }    
        }
        else{
            $res->status(401)->json(['message'=>"User Not Logged!"]);
        }
    }

    // ADD ADDRESS
    public function add_address(Request $req, Response $res){
        if(session('userId')){
            $validation = Validation::check($req->body, [
                'street_name' => ['text'],
                'house_number' => ['required'],
                'postal_code' => ['postal-code'], 
                'city' => ['text'],
                'phone' => ['phone', 'length:10']
            ]);
            
            if($validation==1){
                $user = new User();
                $data = $user->column(['Email'])->where('UserId', '=', session('userId'))->read();

                $userAddress = new UserAddress();
                $arr = [
                    'UserId' => session('userId'), 
                    'AddressLine1' => $req->body->street_name,
                    'AddressLine2' => $req->body->house_number,
                    'City' => $req->body->city,
                    'State' => 'Gujarat',
                    'PostalCode' => $req->body->postal_code,
                    'Email' => $data[0]->Email,
                    'Mobile' => $req->body->phone,
                ];
                $result = $userAddress->create($arr);
                if($result){
                    $res->status(201)->json(['message'=>'Address Add Successfully.']);
                }
                else{
                    $res->status(500)->json(['message'=>'Internal Server Error !']);
                }
            }
            else{
                $res->status(400)->json($validation);
            }    
        }
        else{
            $res->status(401)->json(['message'=>'User Not Logged !']);
        }
    }

    public function book_service(Request $req, Response $res){

        $validation = Validation::check($req->body, [
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

        if($validation==1){
            // INITIALIZE REQUIRED VARIABLE...
            $userId = session('userId');
            $postal_code = $req->body->postal_code;
            $time = $req->body->time;
            $date = $req->body->date;
            $date = $date.' '. $time;
            $date = strtotime($date);
            /*
                HOW SMALL AND CAPITAL LETTER EFFECTS IN DATE...
                d : date number 
                D : date name  [mon, tue, wed, etc..]
                m : month number
                M : month name [jan, feb, march, etc... ]
                y : year have only 2 digits.
                Y : year have 4 digits.
                h : time in 12hr format
                H : time in 24hr format
            */
            $date = date('Y-m-d H:i:s', $date);
            $duration = $req->body->duration;

            // OPTIONAL PARAMETERS...
            $extra = [];
            $extra_time = null;
            $comments = null;
            $has_pets = null;
            $service_provider_id = null;
            if(isset($req->body->extra)){
                $extra = $req->body->extra;
            }
            if(isset($req->body->extra_time)){
                $extra_time = $req->body->extra_time;
            }
            if(isset($req->body->comments)){
                $comments = $req->body->comments;
            }
            if(isset($req->body->has_pets)){
                $has_pets = $req->body->has_pets==true ? 1 : 0;
            }
            if(isset($req->body->sp_id)){
                $sp_id = $req->body->sp_id;
            }

            $hourly_rate = 70;
            $total_cost = $hourly_rate*3 + ($hourly_rate/2)*count($extra);

            // ADD SERVICE_REQUEST IN DATABASE TABLE...
            $arr = ['UserId' => $userId,
                    'ServiceStartDate' => $date,
                    'ZipCode' => $postal_code,
                    'ServiceHourlyRate' => $hourly_rate,
                    'ServiceHours' => $duration,
                    'ExtraHours' => $extra_time,
                    'SubTotal' => $total_cost,
                    'TotalCost' => $total_cost,
                    'Comments' => $comments,
                    'ServiceProviderId' => $service_provider_id,
                    'HasPets' => $has_pets];

            $service = new Service();
            $serviceId = $service->create($arr);

            if($serviceId){
                // ADD EXTRA SERVICES IN DATABASE IF USER WANT'S...
                $extra_service_obj = new ExtraService();
                for($i=0; $i<count($extra); $i++){
                    $extraId = 0;
                    switch($extra[$i]){
                        case 'Cabinet':
                            $extraId = 1;
                            break;
                        case 'Fridge':
                            $extraId = 2;
                            break;
                        case 'Oven':
                            $extraId = 3;
                            break;
                        case 'Laundry':
                            $extraId = 4;
                            break;
                        case 'Window':
                            $extraId = 5;
                            break;
                    }
                    $extra_service_obj->create([
                        'ServiceRequestId' => $serviceId,
                        'ServiceExtraId' => $extraId,
                    ]);
                }

                // ADD SERVICE_REQUEST_ADDRESS IN DATABASE TABLE...
                $arr = [
                    'ServiceRequestId' => $serviceId,
                    'AddressLine1' => $req->body->address->AddressLine1,
                    'AddressLine2' => $req->body->address->AddressLine2,
                    'City' => $req->body->address->City,
                    'State' => $req->body->address->State,
                    'PostalCode' => $req->body->address->PostalCode,
                    'Mobile' => $req->body->address->Mobile,
                    'Email' => $req->body->address->Email,
                ];
    
                $service_address = new ServiceAddress();
                $result = $service_address->create($arr);

                if($result){
                    // *************SERVICE POOLING BAKI 6E****************
                    // **********SEND MAIL TO SP BAKI 6E*******************
                    // SERVICE POOL [SEND MAIL TO ALL SP ACCORDING TO POSTAL CODE]
                    // FIND SERVICE_PROVIDER BY POSTAL CODE AND USERROLEID 2
                    // DIRECT ASSIGNMENT OF USER...
                    session('isBookingCompleted', true);
                    $res->status(201)->json(['message'=>'Service Book Successfully.', 'id'=>$serviceId]);
                }
                else{
                    $res->status(500)->json(['message'=>'Internal Server Error']);
                }
            }
            else{
                $res->status(500)->json(['message'=>'Internal Server Error']);
            }
        }
        else{
            $res->status(400)->json($validation);
        }
    }

}