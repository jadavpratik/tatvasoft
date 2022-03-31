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
        $columns = [
            'user.UserId',
            'user.FirstName',
            'user.LastName',
            'user.CreatedDate',
            'user.RoleId',
            'user.Mobile',
            'useraddress.PostalCode',
            'user.IsActive'
        ];
        $data = $user->columns($columns)->join('UserId', 'UserId', 'useraddress', 'LEFT')->read();
        foreach($data as $key){
            // REMOVE PASSWORD FIELD
            $key->CreatedDate = date('d/m/Y', strtotime($key->CreatedDate));
            unset($key->Password);
        }
        // REMOVE REPEATED OBJECT FROM ARRAY...
        $temp = array_unique(array_column($data, 'UserId'));
        $data = array_values(array_intersect_key($data, $temp));
        
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

        // ----------SEND EMAIL----------
        if(RES_WITH_MAIL){
            $fun = new Functions();
            $emailReceiver = $fun->getUserEmailByUserId($userId);
            $emailSubject = 'Account Activated by Admin';
            $emailBody = $res->template('admin/active-user',  ['$contactLink'=> BASE_URL.'/contact', '$loginLink' => BASE_URL.'/login']);
            Mail::send($emailReceiver, $emailSubject, $emailBody);
            $res->status(200)->json(['message'=>'User actived successfully.']);                
        }
        else{
            $res->status(200)->json(['message'=>'User actived successfully.']);
        }
    }

    // --------MAKE-USER-INSACTIVE----------
    public function make_user_inactive(Request $req, Response $res){
        $userId = $req->params->id;
        $user = new User();
        $user->where('UserId', '=', $userId)->update([
            'IsActive' => 0
        ]);

        if(RES_WITH_MAIL){
            // ----------SEND-MAIL----------
            $fun = new Functions();
            $contactUsLink = BASE_URL.'/contact';
            $emailReceiver = $fun->getUserEmailByUserId($userId);
            $emailSubject = 'Account Diactivated by Admin';
            $emailBody = $res->template('admin/inactive-user', ['$contactLink'=> BASE_URL.'/contact']);
            Mail::send($emailReceiver, $emailSubject, $emailBody);
            $res->status(200)->json(['message'=>'User actived successfully.']);
        }
        else{
            $res->status(200)->json(['message'=>'User inactived successfully.']);
        }

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

        if(RES_WITH_MAIL){
            // ----------SEND-MAIL----------
            $fun = new Functions();
            $temp = $fun->getServiceDetailsByServiceId($serviceId);
            $emailReceiver = $temp->Email;
            $emailData = [];
            foreach($temp as $key => $value){
                $emailData['$'.$key] = $value;
            }
            $emailSubject = "Service Rescheduled By Admin";
            $emailBody = $res->template('/admin/reschedule-service', $emailData);
            Mail::send($emailReceiver, $emailSubject, $emailBody);
            $res->status(200)->json(['message'=>'Service Reschedule successfully.']);
        }
        else{
            $res->status(200)->json(['message'=>'Service Rescheduled By Admin']);
        }

    }

    // --------CANCEL_SERVICE----------
    public function cancel_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        $service = new Service();
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'Status' => $this->CANCELLED_STATUS
        ]);

        if(RES_WITH_MAIL){
            // ----------SEND-MAIL----------
            $fun = new Functions();
            $temp = $fun->getServiceDetailsByServiceId($serviceId);
            $emailData = [];
            $emailReceiver = $temp->Email;
            $emailSubject = "Service Cancled by Admin";
            foreach($temp as $key => $value){
                $emailData['$'.$key] = $value;
            }
            $emailBody = $res->template('/admin/cancel-service', $emailData);
            Mail::send($emailReceiver, $emailSubject, $emailBody);
            $res->status(200)->json(['message'=>'Service cancelled successfully.']);
        }
        else{
            $res->status(200)->json(['message'=>'Service Canceled By Admin']);
        }

    }


}