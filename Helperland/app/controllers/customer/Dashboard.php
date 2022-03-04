<?php

namespace app\controllers\customer;

use core\Request;
use core\Response;
use core\Validation;

use app\models\Service;
use app\models\ExtraService;
use app\models\User;
use app\models\Rating;

class Dashboard{

    private $NEW_REQUEST       = 0;
    private $PENDING_REQUEST   = 1; // (ALSO ACCEPTED BY SP)
    private $COMPLETED_REQUEST = 2;
    private $CANCELLED_REQUEST = 3;

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

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $temp = $extra->where('ServiceRequestId', '=', $data[$i]->ServiceRequestId)->read();
            for($j=0; $j<count($temp); $j++){
                $data[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;                
            }

            // SERVICE PROVIDER DETAILS...
            if($data[$i]->ServiceProviderId!=null){
                $user = new User();
                $temp = $user->where('UserId', '=', $data[$i]->ServiceProviderId)->read();
                $data[$i]->ServiceProvider = $temp[0];
            }

            // RATTING DETAILS...
            $rating = new Rating();
            $temp = $rating->where('ServiceRequestId', '=', $data[$i]->ServiceRequestId)->read();
            if(count($temp)>0 || count($temp)==1){
                $data[$i]->Rating = $temp[0]->Ratings;
            }            
        }
        $res->status(200)->json($data);
    }

    // CURRENT SERVICES...
    public function current_services(Request $req, Response $res){

        $userId = session('userId');
        $service = new Service();
        // STATUS = 0 OR 1 MEANS (NEW OR PENDING)...
        $where = "UserId = {$userId} AND (Status = {$this->PENDING_REQUEST} OR Status = {$this->NEW_REQUEST})";
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

            // EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $temp = $extra->where('ServiceRequestId', '=', $data[$i]->ServiceRequestId)->read();
            for($j=0; $j<count($temp); $j++){
                $data[$i]->ExtraService[] = $temp[$j]->ServiceExtraId;                
            }

            // SERVICE PROVIDER DETAILS...
            if($data[$i]->ServiceProviderId!=null){
                $user = new User();
                $temp = $user->where('UserId', '=', $data[$i]->ServiceProviderId)->read();
                $data[$i]->ServiceProvider = $temp[0];
            }

            // RATTING DETAILS...
            $rating = new Rating();
            $temp = $rating->where('ServiceRequestId', '=', $data[$i]->ServiceRequestId)->read();
            if(count($temp)>0 || count($temp)==1){
                $data[$i]->Rating = $temp[0]->Ratings;
            }
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
            'Status' => $this->CANCELLED_REQUEST,
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
            'ServiceStartDate' => date('Y-m-d H:i:s', strtotime($date.' '.$time)),
            'Status' => $this->NEW_REQUEST
        ]);

        $res->status(200)->json(['message'=>'Service cancelled successfully.']);
    }

    // RATE SERVICE PROVIDER...
    public function rate_service_provider(Request $req, Response $res){

        $serviceId = $req->params->id;

        // Validation::check($req->body, [
        //     'arrival_rating' => ['required'],
        //     'friendly_rating' => ['required'],
        //     'quality_rating' => ['required'],
        //     'rating_feedback' => ['required'],
        // ]);

        $arrival_rating = (int) $req->body->arrival_rating;
        $quality_rating = (int) $req->body->arrival_rating;
        $friendly_rating = (int) $req->body->friendly_rating;
        $rating_feedback = $req->body->rating_feedback;
        $averageRating =  (float) ($arrival_rating + $quality_rating + $friendly_rating )/3;

        $service = new Service();
        $data = $service->where('ServiceRequestId', '=', $serviceId)->read();
        $customerId = $data[0]->UserId;
        $serviceProviderId = $data[0]->ServiceProviderId;

        $rating = new Rating();
        $rating->create([
            'ServiceRequestId' => $serviceId,
            'RatingFrom' => $customerId,
            'RatingTo' => $serviceProviderId,
            'Ratings' => $averageRating,
            'Comments' => $rating_feedback,
            'RatingDate' => date('Y-m-d H:i:s'),
            'OnTimeArrival' => $arrival_rating,
            'Friendly' => $friendly_rating,
            'QualityOfService' => $quality_rating,
        ]);
        
        $res->status(200)->json(['message'=>'Thanks for feedback Us.']);
    }
}