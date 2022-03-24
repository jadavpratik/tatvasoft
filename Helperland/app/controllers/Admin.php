<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Mail;

use app\models\User;
use app\models\Service;
use app\models\ServiceAddress;
use app\models\Rating;
use app\services\Functions;

class Admin{

    private $NEW_STATUS       = 0;
    private $ASSIGNED_STATUS  = 1; // (ACCEPTED BY SP BUT NOT COMPLETED)
    private $COMPLETED_STATUS = 2;
    private $CANCELLED_STATUS = 3;

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

    // --------SERVICE-REQUEST----------
    public function service_requests(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $data = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // ADD CUSTOMER AND SP DETAILS...
        for($i=0; $i<count($data); $i++){

            $data[$i]->TotalCost   = (int) $data[$i]->TotalCost;
            $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
            $data[$i]->StartTime   = date('H:i', strtotime($data[$i]->ServiceStartDate));
            $data[$i]->Duration    = $data[$i]->ServiceHours 
                                          + $data[$i]->ExtraHours;
            $data[$i]->Duration    = date('H:i', mktime(0, $data[$i]->Duration*60));
            $data[$i]->EndTime     = time_to_minutes($data[$i]->StartTime) 
                                   + time_to_minutes($data[$i]->Duration);
            $data[$i]->EndTime     = date('H:i', mktime(0, $data[$i]->EndTime));
            
            $customerId = $data[$i]->UserId;
            $customerData = $user->where('UserId', '=', $customerId)->read();
            unset($customerData[0]->Password);
            $data[$i]->Customer = $customerData[0];

            if($data[$i]->ServiceProviderId!=0 || $data[$i]->ServiceProviderId!=null){
                $serviceProviderId = $data[$i]->ServiceProviderId;
                $serviceProviderData = $user->where('UserId', '=', $serviceProviderId)->read();
                unset($serviceProviderData[0]->Password);
                $data[$i]->ServiceProvider = $serviceProviderData[0];

                // SPECIFIC RATING OF CUSTOMER TO SP
                $rating = new Rating();
                $where = "RatingFrom = {$customerId} AND RatingTo = {$serviceProviderId}";
                $ratingData = $rating->where($where)->read();
                $tempRating = 0;
                if(count($ratingData)>0){
                    for($j=0; $j<count($ratingData); $j++){
                        $tempRating += (float) $ratingData[$j]->Ratings;
                    }
                    $tempRating /= count($ratingData); 
                }
                $data[$i]->ServiceProvider->Rating = $tempRating;

                // STORE RATING ALL OVER RATING...
                // $rating = new Rating();
                // $ratingData = $rating->where('RatingTo', '=', $serviceProviderId)->read();
                // $tempRating = 0;
                // if(count($ratingData)>0){
                //     for($j=0; $j<count($ratingData); $j++){
                //         $tempRating += (float) $ratingData[$j]->Ratings;
                //     }
                //     $tempRating /= count($ratingData); 
                // }
                // $data[$i]->ServiceProvider->Rating = $tempRating;
            }
            
            
        }

        $res->status(200)->json($data);
    }

    // --------MAKE-USER-ACTIVE----------
    public function make_user_active(Request $req, Response $res){
        $userId = $req->params->id;
        $user = new User();
        $user->where('UserId', '=', $userId)->update([
            'IsActive' => 1
        ]);
        $res->status(200)->json(['message'=>'User actived successfully.']);
    }

    // --------MAKE-USER-INSACTIVE----------
    public function make_user_inactive(Request $req, Response $res){
        $userId = $req->params->id;
        $user = new User();
        $user->where('UserId', '=', $userId)->update([
            'IsActive' => 0
        ]);
        $res->status(200)->json(['message'=>'User inactived successfully.']);
    }

    // --------RESCHEDULE_SERVICE----------
    public function reschedule_service(Request $req, Response $res){
        // REQUIRED VALIDATION PENDING...
        $serviceId = $req->params->id;
        $service = new Service();
        $serviceAddress = new ServiceAddress();
        $serviceStartDate = $req->body->date.' '.$req->body->time;
        $serviceStartDate = date('y-m-d h:i:s', strtotime($serviceStartDate));

        // UPDATE SERVICE
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'Status' => $this->NEW_STATUS,
            'ServiceStartDate' => $serviceStartDate
        ]);

        // UPDATE SERVICE ADDRESS
        $serviceAddress->where('ServiceRequestId', '=', $serviceId)->update([
            'AddressLine1' => $req->body->street_name,
            'AddressLine2' => $req->body->house_number,
            'PostalCode' => $req->body->postal_code,
            'City' => $req->body->city
        ]);
        $res->status(200)->json(['message'=>'Service Rescheduled By Admin']);

        // $fun = new Functions();
        // $customerEmail = $fun->getCustomerEmailByServiceId($serviceId);
        // $emailSubject = "Helperland";
        // $emailBody = "You Service is Reschedule by Admin, Your service id {$serviceId}.";
        // if(Mail::send($customerEmail, $emailSubject, $emailBody)){
        //     $res->status(200)->json(['message'=>'Service Reschedule successfully.']);
        // }

    }

    // --------CANCEL_SERVICE----------
    public function cancel_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        $service = new Service();
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'Status' => $this->CANCELLED_STATUS
        ]);
        $res->status(200)->json(['message'=>'Service Canceled By Admin']);

        // ----------MAIL----------
        // $fun = new Functions();
        // $customerEmail = $fun->getCustomerEmailByServiceId($serviceId);
        // $emailSubject = "Helperland";
        // $emailBody = "You Service is Canclled by Admin, Your service id {$serviceId}.";
        // if(Mail::send($customerEmail, $emailSubject, $emailBody)){
        //     $res->status(200)->json(['message'=>'Service cancelled successfully.']);
        // }

    }


}