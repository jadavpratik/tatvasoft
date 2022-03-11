<?php

namespace app\controllers\serviceProvider;

use core\Request;
use core\Response;

use app\models\Service;
use app\models\User;
use app\models\ExtraService;
use app\models\Favorite;

class Dashboard{

    // -------------NEW-SERVICES [STATUS 0 & SP ZIPCODE]-------------
    public function new_services(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // GET SP POSTAL CODE...
        $spData = $user->where('UserId', '=', $userId)->read();
        $zipCode = $spData[0]->ZipCode;

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ZipCode = {$zipCode} AND Status=0";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY SERVICE DATA...
        for($i=0; $i<count($serviceData); $i++){
            // TOTAL COST
            $serviceData[$i]->TotalCost = (int) $serviceData[$i]->TotalCost;
            // DATE IN DD/MM/YYYY FORMAT
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            // START TIME (24 HOUR FORMAT)
            $serviceData[$i]->StartTime = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            // TOTAL TIME (IN INTEGER)
            $serviceData[$i]->intDuration = $serviceData[$i]->ServiceHours + $serviceData[$i]->ExtraHours;
            // TOTAL TIME ( IN HOURS)
            $serviceData[$i]->Duration = date('H:i', mktime(0, $serviceData[$i]->intDuration*60));
            // END TIME (24 HOUR FORMAT)
            $serviceData[$i]->EndTime = date('H:i', mktime(0, time_to_minutes($serviceData[$i]->StartTime) + time_to_minutes($serviceData[$i]->Duration)));
            
            // CHECK IS SERVICE EXPIRE...
            $serviceDate = strtotime($serviceData[$i]->ServiceStartDate);
            $todayDate = strtotime(date('Y-m-d H:i:s'));
            $serviceData[$i]->IsExpired = $serviceDate < $todayDate ? 1 : 0;

            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $temp = $extra->where('ServiceRequestId', '=', $serviceData[$i]->ServiceRequestId)->read();
            for($j=0; $j<count($temp); $j++){
                $serviceData[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;
            }
                        
        }

        $res->status(200)->json($serviceData);
    }

    // -------------UPCOMING-SERVICES[STATUS 1 ALREADY ASSIGNED TO SP]-------------
    public function upcoming_services(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId} AND Status = 1";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY SERVICE DATA...
        for($i=0; $i<count($serviceData); $i++){
            // TOTAL COST
            $serviceData[$i]->TotalCost = (int) $serviceData[$i]->TotalCost;
            // DATE IN DD/MM/YYYY FORMAT
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            // START TIME (24 HOUR FORMAT)
            $serviceData[$i]->StartTime = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            // TOTAL TIME (IN INTEGER)
            $serviceData[$i]->intDuration = $serviceData[$i]->ServiceHours + $serviceData[$i]->ExtraHours;
            // TOTAL TIME ( IN HOURS)
            $serviceData[$i]->Duration = date('H:i', mktime(0, $serviceData[$i]->intDuration*60));
            // END TIME (24 HOUR FORMAT)
            $serviceData[$i]->EndTime = date('H:i', mktime(0, time_to_minutes($serviceData[$i]->StartTime) + time_to_minutes($serviceData[$i]->Duration)));

            // CHECK IS SERVICE EXPIRE...
            $serviceDate = strtotime($serviceData[$i]->ServiceStartDate);
            $todayDate = strtotime(date('Y-m-d H:i:s'));
            $serviceData[$i]->IsExpired = $serviceDate < $todayDate ? 1 : 0;
            
            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $temp = $extra->where('ServiceRequestId', '=', $serviceData[$i]->ServiceRequestId)->read();
            for($j=0; $j<count($temp); $j++){
                $serviceData[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;
            }
            
        }

        $res->status(200)->json($serviceData);
    }

    // -------------SERVICE_HISTORY(ALL STATUS )-------------
    public function service_history(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId}";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY SERVICE DATA...
        for($i=0; $i<count($serviceData); $i++){
            // TOTAL COST
            $serviceData[$i]->TotalCost = (int) $serviceData[$i]->TotalCost;
            // DATE IN DD/MM/YYYY FORMAT
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            // START TIME (24 HOUR FORMAT)
            $serviceData[$i]->StartTime = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            // TOTAL TIME (IN INTEGER)
            $serviceData[$i]->intDuration = $serviceData[$i]->ServiceHours + $serviceData[$i]->ExtraHours;
            // TOTAL TIME ( IN HOURS)
            $serviceData[$i]->Duration = date('H:i', mktime(0, $serviceData[$i]->intDuration*60));
            // END TIME (24 HOUR FORMAT)
            $serviceData[$i]->EndTime = date('H:i', mktime(0, time_to_minutes($serviceData[$i]->StartTime) + time_to_minutes($serviceData[$i]->Duration)));

            // CHECK IS SERVICE EXPIRE...
            $serviceDate = strtotime($serviceData[$i]->ServiceStartDate);
            $todayDate = strtotime(date('Y-m-d H:i:s'));
            $serviceData[$i]->IsExpired = $serviceDate < $todayDate ? 1 : 0;

            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['FirstName', 'LastName'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i]->CustomerName = $customerData[0]->FirstName.' '.$customerData[0]->LastName;

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $temp = $extra->where('ServiceRequestId', '=', $serviceData[$i]->ServiceRequestId)->read();
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
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId} AND Status = 2";
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
            // TOTAL COST
            $serviceData[$i]->TotalCost = (int) $serviceData[$i]->TotalCost;
            // DATE IN DD/MM/YYYY FORMAT
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            // START TIME (24 HOUR FORMAT)
            $serviceData[$i]->StartTime = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            // TOTAL TIME (IN INTEGER)
            $serviceData[$i]->intDuration = $serviceData[$i]->ServiceHours + $serviceData[$i]->ExtraHours;
            // TOTAL TIME ( IN HOURS)
            $serviceData[$i]->Duration = date('H:i', mktime(0, $serviceData[$i]->intDuration*60));
            // END TIME (24 HOUR FORMAT)
            $serviceData[$i]->EndTime = date('H:i', mktime(0, time_to_minutes($serviceData[$i]->StartTime) + time_to_minutes($serviceData[$i]->Duration)));
                        
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
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId} AND Status = 2";
        $serviceData = $service->where($where)->read();
        
        // MODIFY DATA...
        $customers = [];
        for($i=0; $i<count($serviceData); $i++){
            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['UserId', 'FirstName', 'LastName', 'Email', 'Mobile'])->where('UserId', '=', $customerId)->read();

            // ADD FAVORITE AND BLOCKED DATA...
            $fav = new Favorite();
            $favData = $fav->where('TargetUserId', '=', $customerId)->read();
            if(isset($favData[0])){
                $customerData[0]->IsFavorite = $favData[0]->IsFavorite;
                $customerData[0]->IsBlocked = $favData[0]->IsBlocked;
            }
            $serviceData[$i] = $customerData[0];

        }

        // REMOVE REPEATED OBJECT FROM ARRAY...
        $temp = array_unique(array_column($serviceData, 'UserId'));
        $customers = array_values(array_intersect_key($serviceData, $temp));
        $res->status(200)->json($customers);

    }    

    // -------------ACCEPT-SERVICE-------------
    public function accept_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        // STATUS 1 MEANS ACCEPT BUT NOT COMPLETED..
        $service = new Service();
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'ServiceProviderId' => session('userId'),
            'SPAcceptedDate' => date('Y-m-d H:i:s'),
            'Status' => 1,
            'ModifiedDate' => date('Y-m-d H:i:s'),
        ]);
        $res->status(200)->json(['message'=>'Service Accepted Successfully.']);
    }

    // -------------COMPLETE-SERVICE-------------
    public function complete_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        // STATUS 2 MEANS COMPLETED SERVICE..
        $service = new Service();

        // CHECK IS SERVICE EXPIRE...
        $serviceData = $service->where('ServiceRequestId', '=', $serviceId)->read();
        $serviceDate = strtotime($serviceData[0]->ServiceStartDate);
        $todayDate = strtotime(date('Y-m-d H:i:s'));
        $isExpired = $serviceDate < $todayDate ? 1 : 0;

        if($isExpired){
            $service->where('ServiceRequestId', '=', $serviceId)->update([
                'ServiceProviderId' => session('userId'),
                'Status' => 2,
                'ModifiedDate' => date('Y-m-d H:i:s'),
            ]);
            $res->status(200)->json(['message'=>'Service Completed Successfully.']);    
        }
        else{
            $res->status(200)->json(['message'=>'Service not able to completed']);    
        }

    }
   
    // -------------CANCEL-OR-REJECT-SERVICE-------------
    public function reject_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        // STATUS 3 MEANS CANCELED SERVICE..
        $service = new Service();
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'ServiceProviderId' => session('userId'),
            'SPAcceptedDate' => date('Y-m-d H:i:s'),
            'Status' => 3,
            'ModifiedDate' => date('Y-m-d H:i:s'),
        ]);
        $res->status(200)->json(['message'=>'Service Rejected Successfully.']);
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