<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;
use core\Validation;

use app\models\Service;

class Dashboard{

    /* 
        Status : 1    (COMPLETED)
        Status : 2    (CANCELLED)
        Status : NULL (PENDING OR NOT COMPLETED)
    */

    // ALL SERVICES...
    public function all_services(Request $req, Response $res){

        $userId = session('userId');
        $service = new Service();
        $where = "UserId = {$userId}";
        $data = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->where($where)->read();
       
        // BAKI 6E... EXTRA SERVICE TABLE NE JOIN KARVANU...
        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        for($i=0; $i<count($data); $i++){
            // TOTAL COST
            $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
            // DATE IN DD/MM/YYYY FORMAT
            $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
            // START TIME (24 HOUR FORMAT)
            $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
            // TOTAL TIME (IN INTEGER)
            $data[$i]->intDuration = $data[$i]->ServiceHours + $data[$i]->ExtraHours;
            // TOTAL TIME ( IN HOURS)
            $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->intDuration*60));
            // END TIME (24 HOUR FORMAT)
            $data[$i]->EndTime = date('H:i', mktime(0, time_to_minutes($data[$i]->StartTime) + time_to_minutes($data[$i]->Duration)));
        }
        $res->status(200)->json($data);
    }

    // CURRENT SERVICES...
    public function current_services(Request $req, Response $res){

        $userId = session('userId');
        $service = new Service();
        $where = "UserId = {$userId} AND Status IS NULL";
        $data = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->where($where)->read();
       
        // BAKI 6E... EXTRA SERVICE TABLE NE JOIN KARVANU...
        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        for($i=0; $i<count($data); $i++){
            // TOTAL COST
            $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
            // DATE IN DD/MM/YYYY FORMAT
            $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
            // START TIME (24 HOUR FORMAT)
            $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
            // TOTAL TIME (IN INTEGER)
            $data[$i]->intDuration = $data[$i]->ServiceHours + $data[$i]->ExtraHours;
            // TOTAL TIME ( IN HOURS)
            $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->intDuration*60));
            // END TIME (24 HOUR FORMAT)
            $data[$i]->EndTime = date('H:i', mktime(0, time_to_minutes($data[$i]->StartTime) + time_to_minutes($data[$i]->Duration)));
        }
        $res->status(200)->json($data);
    }

    // CANCEL SERVICE...
    public function cancel_service(Request $req, Response $res){

        Validation::check($req->body, [
            'reason' => ['string']
        ]);

        $serviceId = $req->params->id;
        $service = new Service();

        // REASON STORE IN DATABASE PENDING...
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'Status' => 2,
        ]);

        $res->status(200)->json(['message'=>'Service cancelled successfully.']);
    }
    
    // RESCHEDULE SERVICE...
    public function reschedule_service(Request $req, Response $res){

        // DATE & TIME PROPER VALIDATION PENDING...
        Validation::check($req->body, [
            'new_service_date' => ['required'],
            'new_service_time' => ['required']
        ]);

        $serviceId = $req->params->id;
        $date = $req->body->new_service_date;
        $time = $req->body->new_service_time;
        $service = new Service();

        // REASON STORE IN DATABASE PENDING...
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'ServiceStartDate' => date('Y-m-d H:i:s', strtotime($date.' '.$time) ),
        ]);

        $res->status(200)->json(['message'=>'Service cancelled successfully.']);
    }

}