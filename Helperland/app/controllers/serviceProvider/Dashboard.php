<?php

namespace app\controllers\serviceProvider;

use core\Request;
use core\Response;

use app\models\Service;
use app\models\User;
use app\models\ExtraService;

class Dashboard{

    // -------------NEW-SERVICES-------------
    public function new_services(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // GET SP POSTAL CODE...
        $spData = $user->where('UserId', '=', $userId)->read();
        $zipCode = $spData[0]->ZipCode;

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->where('ZipCode', '=', $zipCode)->read();

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

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $temp = $extra->where('ServiceRequestId', '=', $serviceData[$i]->ServiceRequestId)->read();
            for($j=0; $j<count($temp); $j++){
                $serviceData[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;
            }
                        
        }

        $res->status(200)->json($serviceData);
    }

    // -------------UPCOMING-SERVICES-------------
    public function upcoming_services(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId} AND Status = 0";
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

    // -------------SERVICE_HISTORY-------------
    public function service_history(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId} AND Status = 2";
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

    // -------------SERVICE-PROVIDER'S CUSTOMER LIST...-------------
    public function my_customer(Request $req, Response $res){
        $service = new Service();
        $user = new User();
        $userId = session('userId');

        // SERVICES COMING ACCORDING TO POSTAL CODE...
        $where = "ServiceProviderId = {$userId} AND Status = 2";
        $serviceData = $service->where($where)->read();
        
        // MODIFY DATA...
        for($i=0; $i<count($serviceData); $i++){
            // ADD CUSTOMER DETAILS...
            $customerId = $serviceData[$i]->UserId;
            $customerData = $user->columns(['UserId', 'FirstName', 'LastName', 'Email', 'Mobile'])->where('UserId', '=', $customerId)->read();
            $serviceData[$i] = $customerData[0];
        }

        $res->status(200)->json($serviceData);

    }    

}