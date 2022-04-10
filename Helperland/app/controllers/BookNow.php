<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Validation;
use core\Database;
use core\Mail;

use app\models\User;
use app\models\UserAddress;
use app\models\Service;
use app\models\ServiceAddress;
use app\models\ExtraService;
use app\models\Favorite;
use app\services\Functions;

class BookNow{

    // ----------CHECK POSTAL CODE---------- 
    public function check_postal_code(Request $req, Response $res){

        Validation::check($req->body, [
            'postal_code' => ['postal-code']
        ]);

        $user = new User();
        $where = "RoleId = 2 AND PostalCode = {$req->body->postal_code}";
        $users = $user->join('UserId', 'UserId', 'useraddress')->where($where)->read();
        if(count($users)>0){
            $res->status(200)->json(['message'=>'User availabe']);
        }
        else{
            $res->status(404)->json(['message'=>'No service providing in this area!']);
        }    

    }

    // ----------GET CUSTOMER ADDRESS----------
    public function get_address(Request $req, Response $res){
        $userAddress = new UserAddress();
        $customerId = session('userId');
        $result = $userAddress->where('UserId', '=', $customerId)->read();
        $res->status(200)->json(['address'=>$result]);
    }

    // ----------ADD ADDRESS----------
    public function add_address(Request $req, Response $res){
        Validation::check($req->body, [
            'street_name' => ['text'],
            'house_number' => ['required'],
            'postal_code' => ['postal-code'], 
            'city' => ['text'],
            'phone' => ['phone', 'length:10']
        ]);

        $user = new User();
        $fun = new Functions();
        $email = $fun->getUserEmailByUserId(session('userId'));
        $userAddress = new UserAddress();

        $userAddress->create([
            'UserId' => session('userId'), 
            'AddressLine1' => $req->body->street_name,
            'AddressLine2' => $req->body->house_number,
            'City' => $req->body->city,
            'State' => 'Gujarat',
            'PostalCode' => $req->body->postal_code,
            'Email' => $email,
            'Mobile' => $req->body->phone,
        ]);
        $res->status(200)->json(['message'=>'Address Add Successfully.']);
    }

    // ----------BOOK SERVICE----------
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

        $customerId = session('userId');
        $postal_code = $req->body->postal_code;
        $date = strtotime($req->body->date.' '.$req->body->time);
        $date = date('Y-m-d H:i:s', $date);
        $duration = (int) $req->body->duration;
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
        }
        $hourly_rate = 20;
        $total_cost = $hourly_rate*$duration + ($hourly_rate/2)*count($extra);
        // ADD SERVICE_REQUEST IN DATABASE TABLE...
        $serviceId = $service->create([
            'UserId' => $customerId,
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
            $temp = '';
            for($i=0; $i<count($extra); $i++){
                $temp .= "( {$serviceId}, {$extra[$i]} ), ";
            }    
            $temp = rtrim($temp, ', ');
            $sql = "INSERT INTO servicerequestextra (ServiceRequestId, ServiceExtraId) VALUES {$temp}";
            $db = new Database();
            $db->query($sql);        
        }

        if(RES_WITH_MAIL){
            // ----------SEND MAIL----------
            // SEND MAIL TO CUSTOMER WHO MADE A REQUEST (FOR THEIR CONFIRMATION)
            $fun = new Functions();
            $customer = $fun->getUserDetailsByUserId($customerId);
            $emailReceiver = $customer->Email;
            $emailSubject = 'Service Booking';
            $temp = $fun->getServiceDetailsByServiceId($serviceId);
            $emailData = [];
            foreach($temp as $key => $value){
                $emailData['$'.$key] = $value;
            }
            $emailBody = $res->template('/book-service/customer', $emailData);

            Mail::send($emailReceiver, $emailSubject, $emailBody);

            // DIRECT ASSIGNMENT OF USER BY SERVICE PROVIDER ID...
            if($sp_id!=null){
                if(!$fun->isUserBlockedByAnotherUser($sp_id)){
                    $emailReceiver = $fun->getUserEmailByUserId($sp_id);
                    $emailSubject = 'Assigned for Service Cleaning';
                    $emailBody = $res->template('book-service/single-sp', $emailData); 
                    Mail::send($emailReceiver, $emailSubject, $emailBody);
                    $res->status(201)->json(['message'=>'Service Book Successfully.', 'id'=>$serviceId]);
                }
            }
            else{
                // SERVICE POOL [SEND MAIL TO ALL SP ACCORDING TO POSTAL CODE]
                $emailReceivers = $fun->getSPEmailsByPostalCode($postal_code);
                $emailSubject = 'Service Booked In Your Area';
                $emailBody = $res->template('/book-service/multiple-sp', $emailData);
                Mail::send($emailReceivers[0], $emailSubject, $emailBody, $emailReceivers);
                $res->status(201)->json(['message'=>'Service Book Successfully.', 'id'=>$serviceId]);
            }
        }
        else{
            $res->status(201)->json(['message'=>'Service Book Successfully.', 'id'=>$serviceId]);
        }
    }

    // ----------GET FAVORITE SP----------
    public function get_favorite_sp(Request $req, Response $res){
        $customerId = session('userId');
        $db = new Database();
        $sql = "SELECT user.UserId,
                       user.FirstName,
                       user.LastName,
                       user.UserProfilePicture
                FROM user
                INNER JOIN favoriteandblocked AS favorite ON user.UserId = favorite.TargetUserId 
                WHERE favorite.UserId = {$customerId} AND favorite.IsFavorite=1
                HAVING (
                         SELECT COUNT(*) FROM favoriteandblocked WHERE
                         (UserId = {$customerId} AND TargetUserId = user.UserId AND IsBlocked = 1 ) OR
                         (TargetUserId = {$customerId} AND UserId = user.UserId AND IsBlocked = 1)
                        )=0";
        $data = $db->query($sql);
        $res->status(200)->json($data);
    }

}