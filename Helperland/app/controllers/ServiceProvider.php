<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Mail;

use app\models\Service;
use app\models\User;
use app\models\UserAddress;
use app\models\ExtraService;
use app\models\Favorite;
use app\services\Functions;

class ServiceProvider{

    private $NEW_STATUS       = 0;
    private $ASSIGNED_STATUS  = 1; // (ACCEPTED BY SP BUT NOT COMPLETED)
    private $COMPLETED_STATUS = 2;
    private $CANCELLED_STATUS = 3;
    
    // -------------NEW-SERVICES [NEW REQUESTS ONLY BY SP ZIPCODE]-------------
    public function new_services(Request $req, Response $res){
        $service = new Service();
        $userAddress = new UserAddress();
        $serviceProviderId = session('userId');

        // GET SP POSTAL CODE...
        $spData = $userAddress->where('UserId', '=', $serviceProviderId)->read();

        if(isset($spData[0]->PostalCode)){
            $zipCode = $spData[0]->PostalCode;
            // IF SP ZIPCODE AVAIABLE THEN ONLY SHOW THE ACCORDING DATA...
            if($spData[0]->PostalCode!=null && $spData[0]->PostalCode!=""){
                // SERVICES COMING ACCORDING TO POSTAL CODE...
                $where = "ZipCode = {$zipCode} AND Status = {$this->NEW_STATUS}";
                $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')
                                    ->where($where)->read();

                function time_to_minutes($time){
                    $temp = explode(':', $time);
                    $hours = (int) $temp[0];
                    $minutes = (int) $temp[1];
                    $totalMinutes = $hours*60 + $minutes;
                    return $totalMinutes;
                }

                // MODIFY SERVICE DATA...
                for($i=0; $i<count($serviceData); $i++){
                    $serviceData[$i]->TotalCost   = (int) $serviceData[$i]->TotalCost;
                    $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
                    $serviceData[$i]->StartTime   = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
                    $serviceData[$i]->Duration    = $serviceData[$i]->ServiceHours 
                                                    + $serviceData[$i]->ExtraHours;
                    $serviceData[$i]->Duration    = date('H:i', mktime(0, $serviceData[$i]->Duration*60));
                    $serviceData[$i]->EndTime     = time_to_minutes($serviceData[$i]->StartTime) 
                                                    + time_to_minutes($serviceData[$i]->Duration);
                    $serviceData[$i]->EndTime     = date('H:i', mktime(0, $serviceData[$i]->EndTime));

                    // CHECK SERVICE EXPIRE OR NOT?...
                    $serviceDate = strtotime($serviceData[$i]->ServiceStartDate);
                    $todayDate = strtotime(date('Y-m-d H:i:s'));
                    $serviceData[$i]->IsExpired = $serviceDate < $todayDate ? 1 : 0;

                    // ADD CUSTOMER DETAILS...
                    $customerId = $serviceData[$i]->UserId;
                    $user = new User();
                    $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
                    $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

                    // EXTRA SERVICE DETAILS...
                    $extra = new ExtraService();
                    $serviceId = $serviceData[$i]->ServiceRequestId;
                    $temp = $extra->where('ServiceRequestId', '=', $serviceId)->read();
                    for($j=0; $j<count($temp); $j++){
                        $serviceData[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;
                    }
                }
                $res->status(200)->json($serviceData);            
            }
        }
        else{
            // NOT TO SET 400 STATUS OTHERWISE DATATABLE GIVE AN ERROR...
            // SO SIMPLY PASS EMPTY ARRAYS...
            $res->status(200)->json([]);
        }
    }

    // -------------UPCOMING-SERVICES[ALREADY ASSIGNED TO SP]-------------
    public function upcoming_services(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $serviceProviderId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$serviceProviderId} AND Status = {$this->ASSIGNED_STATUS}";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')
                               ->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY SERVICE DATA...
        for($i=0; $i<count($serviceData); $i++){
            $serviceData[$i]->TotalCost   = (int) $serviceData[$i]->TotalCost;
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->StartTime   = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->Duration    = $serviceData[$i]->ServiceHours 
                                          + $serviceData[$i]->ExtraHours;
            $serviceData[$i]->Duration    = date('H:i', mktime(0, $serviceData[$i]->Duration*60));
            $serviceData[$i]->EndTime     = time_to_minutes($serviceData[$i]->StartTime) 
                                          + time_to_minutes($serviceData[$i]->Duration);
            $serviceData[$i]->EndTime     = date('H:i', mktime(0, $serviceData[$i]->EndTime));

            // CHECK SERVICE EXPIRE OR NOT?...
            $serviceDate = strtotime($serviceData[$i]->ServiceStartDate);
            $todayDate = strtotime(date('Y-m-d H:i:s'));
            $serviceData[$i]->IsExpired = $serviceDate < $todayDate ? 1 : 0;

            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $serviceId = $serviceData[$i]->ServiceRequestId;
            $temp = $extra->where('ServiceRequestId', '=', $serviceId)->read();
            for($j=0; $j<count($temp); $j++){
                $serviceData[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;
            }
            
        }

        $res->status(200)->json($serviceData);
    }

    // -------------SERVICE_HISTORY(CANCELLED OR COMPLETED)-------------
    public function service_history(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $serviceProviderId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$serviceProviderId} AND (Status = {$this->COMPLETED_STATUS} OR Status = {$this->CANCELLED_STATUS})";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')
                               ->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY SERVICE DATA...
        for($i=0; $i<count($serviceData); $i++){
            $serviceData[$i]->TotalCost   = (int) $serviceData[$i]->TotalCost;
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->StartTime   = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->Duration    = $serviceData[$i]->ServiceHours 
                                          + $serviceData[$i]->ExtraHours;
            $serviceData[$i]->Duration    = date('H:i', mktime(0, $serviceData[$i]->Duration*60));
            $serviceData[$i]->EndTime     = time_to_minutes($serviceData[$i]->StartTime) 
                                          + time_to_minutes($serviceData[$i]->Duration);
            $serviceData[$i]->EndTime     = date('H:i', mktime(0, $serviceData[$i]->EndTime));

            // CHECK SERVICE EXPIRE OR NOT?...
            $serviceDate = strtotime($serviceData[$i]->ServiceStartDate);
            $todayDate = strtotime(date('Y-m-d H:i:s'));
            $serviceData[$i]->IsExpired = $serviceDate < $todayDate ? 1 : 0;

            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $serviceId = $serviceData[$i]->ServiceRequestId;
            $temp = $extra->where('ServiceRequestId', '=', $serviceId)->read();
            for($j=0; $j<count($temp); $j++){
                $serviceData[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;
            }
            
        }

        $res->status(200)->json($serviceData);
    }

    // -------------MY-RATING-------------
    public function my_rating(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $serviceProviderId = session('userId');

        $where = "ServiceProviderId = {$serviceProviderId} AND Status = {$this->COMPLETED_STATUS}";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'rating')->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY SERVICE DATA...
        for($i=0; $i<count($serviceData); $i++){
            $serviceData[$i]->TotalCost   = (int) $serviceData[$i]->TotalCost;
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->StartTime   = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->Duration    = $serviceData[$i]->ServiceHours 
                                          + $serviceData[$i]->ExtraHours;
            $serviceData[$i]->Duration    = date('H:i', mktime(0, $serviceData[$i]->Duration*60));
            $serviceData[$i]->EndTime     = time_to_minutes($serviceData[$i]->StartTime) 
                                          + time_to_minutes($serviceData[$i]->Duration);
            $serviceData[$i]->EndTime     = date('H:i', mktime(0, $serviceData[$i]->EndTime));

                        
            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

            // IN WHICH CATEGORY HIGHEST RATING GOT BY CUSTOMER...
            $ratingArr = [
                (float) $serviceData[$i]->OnTimeArrival,
                (float) $serviceData[$i]->Friendly,
                (float) $serviceData[$i]->QualityOfService
            ];
            $HighestRating = max($ratingArr);
            switch($HighestRating){
                case $ratingArr[0]:
                    $serviceData[$i]->HighestRating = 'On Time Arrival';
                    break;
                case $ratingArr[1]:
                    $serviceData[$i]->HighestRating = 'Friendly';
                    break;
                case $ratingArr[2]:
                    $serviceData[$i]->HighestRating = 'Quality Of Service';
                    break;
            }
        }

        $res->status(200)->json($serviceData);

    }

    // -------------SERVICE-PROVIDER'S CUSTOMER LIST-------------
    public function my_customer(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $serviceProviderId = session('userId');

        $where = "ServiceProviderId = {$serviceProviderId} AND Status = {$this->COMPLETED_STATUS}";
        $serviceData = $service->where($where)->read();
        
        // MODIFY DATA...
        $customers = [];
        for($i=0; $i<count($serviceData); $i++){
            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['UserId', 'FirstName', 'LastName', 'Email', 'Mobile'])->where('UserId', '=', $customerId)->read();

            // ADD BLOCKED CUSTOMER DATA...
            $favorite = new Favorite();
            $where = "UserId = {$serviceProviderId} AND TargetUserId = {$customerId}";
            $blockedData = $favorite->where($where)->read();
            if(isset($blockedData[0])){
                $customerData[0]->IsBlocked = $blockedData[0]->IsBlocked;
            }

            $customers[] = $customerData[0];

        }
        // REMOVE REPEATED OBJECT FROM ARRAY...
        $temp = array_unique(array_column($customers, 'UserId'));
        $customers = array_values(array_intersect_key($customers, $temp));
        $res->status(200)->json($customers);

    }    

    // -------------ACCEPT-SERVICE-------------
    public function accept_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        $service = new Service();
        $where = "Status = {$this->ASSIGNED_STATUS} AND ServiceRequestId = {$serviceId}";
        if(!$service->where($where)->exists()){
            $service->where('ServiceRequestId', '=', $serviceId)->update([
                'ServiceProviderId' => session('userId'),
                'SPAcceptedDate' => date('Y-m-d H:i:s'),
                'Status' => $this->ASSIGNED_STATUS,
                'ModifiedDate' => date('Y-m-d H:i:s'),
            ]);
            $res->status(200)->json(['message'=>'Service accepted successfully.']);    

            // ----------MAIL----------
            // SEND EMAIL TO SP FOR THEIR CONFIRMATION...
            // $fun = new Functions();
            // $email = $fun->getEmailByUserId(session('userId'));
            // if(Mail::send($email, 'Helperland', "You are accepted service <br> ServiceRequestId={$serviceId}")){
            //     $customerEmail = $fun->getCustomerEmailByServiceId($serviceId);
            //     $serviceProvider = $fun->getDetailsByUserId(session('userId'));
            //     $emailBody = "Your service accepted by Service Provider, details is mentioned below...<br>
            //                   <b>Service Id</b>: {$serviceId} <br> 
            //                   <b>Service Provider Name </b>: {$serviceProvider->FirstName} {$serviceProvider->LastName} <br> 
            //                   <b>Service Provider Email</b>: {$serviceProvider->Email} <br>
            //                   <b>Service Provider Mobile</b>: {$serviceProvider->Mobile} ";
            //     if(Mail::send($customerEmail, 'Helperland', $emailBody)){
            //         $res->status(200)->json(['message'=>'Service accepted successfully.']);
            //     }
            // }
        }
        else{
            $res->status(400)->json(['message'=>'Service already assigned to another service provider!']);
        }
    }

    // -------------COMPLETE-SERVICE-------------
    public function complete_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        $service = new Service();

        // CHECK IS SERVICE EXPIRE...
        $serviceData = $service->where('ServiceRequestId', '=', $serviceId)->read();
        $serviceDate = strtotime($serviceData[0]->ServiceStartDate);
        $todayDate = strtotime(date('Y-m-d H:i:s'));
        $isExpired = $serviceDate < $todayDate ? 1 : 0;

        if($isExpired){
            $service->where('ServiceRequestId', '=', $serviceId)->update([
                'ServiceProviderId' => session('userId'),
                'Status' => $this->COMPLETED_STATUS,
                'ModifiedDate' => date('Y-m-d H:i:s'),
            ]);
            $res->status(200)->json(['message'=>'Service Completed Successfully.']);    

            // ----------MAIL----------
            // SEND EMAIL TO SP FOR THEIR CONFIRMATION...
            // $fun = new Functions();
            // $email = $fun->getEmailByUserId(session('userId'));
            // if(Mail::send($email, 'Helperland', "You are completed service <br> ServiceRequestId={$serviceId}")){
            //     $customerEmail = $fun->getCustomerEmailByServiceId($serviceId);
            //     $serviceProvider = $fun->getDetailsByUserId(session('userId'));
            //     $emailBody = "Your service is completed by Service Provider, details is mentioned below...<br>
            //                   <b>Service Id</b>: {$serviceId} <br> 
            //                   <b>Service Provider Name </b>: {$serviceProvider->FirstName} {$serviceProvider->LastName} <br> 
            //                   <b>Service Provider Email</b>: {$serviceProvider->Email} <br>
            //                   <b>Service Provider Mobile</b>: {$serviceProvider->Mobile} ";
            //     if(Mail::send($customerEmail, 'Helperland', $emailBody)){
            //         $res->status(200)->json(['message'=>'Service Completed Successfully.']);    
            //     }
            // }
        }
        else{
            $res->status(401)->json(['message'=>'Service not able to completed']);
        }

    }
   
    // -------------CANCEL-OR-REJECT-SERVICE-------------
    public function reject_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        $service = new Service();
        $where = "ServiceRequestId = {$serviceId} AND Status = {$this->ASSIGNED_STATUS}";
        if($service->where($where)->exists()){
            $service->where('ServiceRequestId', '=', $serviceId)->update([
                'ServiceProviderId' => session('userId'),
                'SPAcceptedDate' => date('Y-m-d H:i:s'),
                'Status' => 3,
                'ModifiedDate' => date('Y-m-d H:i:s'),
            ]);
            $res->status(200)->json(['message'=>'Service rejected successfully.']);

            // $fun = new Functions();
            // $email = $fun->getEmailByUserId(session('userId'));
            // if(Mail::send($email, 'Helperland', "You are reject service <br> ServiceRequestId={$serviceId}")){
            //     $customerEmail = $fun->getCustomerEmailByServiceId($serviceId);
            //     $serviceProvider = $fun->getDetailsByUserId(session('userId'));
            //     $emailBody = "Your service is rejected by Service Provider, details is mentioned below...<br>
            //                   <b>Service Id</b>: {$serviceId} <br> 
            //                   <b>Service Provider Name </b>: {$serviceProvider->FirstName} {$serviceProvider->LastName} <br> 
            //                   <b>Service Provider Email</b>: {$serviceProvider->Email} <br>
            //                   <b>Service Provider Mobile</b>: {$serviceProvider->Mobile} ";
            //     if(Mail::send($customerEmail, 'Helperland', $emailBody)){
            //         $res->status(200)->json(['message'=>'Service rejected Successfully.']);    
            //     }
            // }

        }
        else{
            $res->status(404)->json(['message'=>'No service available!']);    
        }
    }

    // -------------BLOCK-CUSTOMER-------------
    public function block_customer(Request $req, Response $res){
        $customerId = $req->params->id;
        $serviceProviderId = session('userId');
        $fav = new Favorite();
        $where = "UserId = {$serviceProviderId} AND TargetUserId = {$customerId}";
        if(!$fav->where($where)->exists()){
            $fav->create([
                'UserId' => $serviceProviderId,
                'TargetUserId' => $customerId,
                'IsFavorite' => 0,
                'IsBlocked' => 1,
            ]);    
        }
        else{
            $fav->where($where)->update([
                'IsBlocked' => 1,
            ]);    
        }
        $res->status(200)->json(['message'=>'Block Customer Successfully.']);
    }

    // -------------UNBLOCK-CUSTOMER-------------
    public function unblock_customer(Request $req, Response $res){
        $customerId = $req->params->id;
        $serviceProviderId = session('userId');
        $fav = new Favorite();
        $where = "UserId = {$serviceProviderId} AND TargetUserId = {$customerId}";
        $fav->where($where)->update([
            'IsBlocked' => 0,
        ]);    
        $res->status(200)->json(['message'=>'Unblock Customer Successfully.']);
    }

}