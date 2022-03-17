<?php

namespace app\controllers;

use core\Request;
use core\Response;
use core\Validation;
use core\Database;

use app\models\Service;
use app\models\ExtraService;
use app\models\User;
use app\models\Rating;
use app\models\Favorite;

class Customer{

    private $NEW_STATUS       = 0;
    private $ASSIGNED_STATUS  = 1; // (ACCEPTED BY SP BUT NOT COMPLETED)
    private $COMPLETED_STATUS = 2;
    private $CANCELLED_STATUS = 3;

    // ----------SERVICES HISTORY (COMPLETED & CANCELLED)----------
    public function service_history(Request $req, Response $res){

        $customerId = session('userId');
        $service = new Service();
        $where = "UserId = {$customerId} AND (Status = {$this->COMPLETED_STATUS} OR Status = {$this->CANCELLED_STATUS})";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')
                               ->where($where)->read();
       
        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY DATA...
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

            // ADD EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $serviceId = $serviceData[$i]->ServiceRequestId;
            $extraServiceData = $extra->where('ServiceRequestId', '=', $serviceId)->read();
            for($j=0; $j<count($extraServiceData); $j++){
                $serviceData[$i]->ExtraService[] = $extraServiceData[$j]->ServiceExtraId;                
            }

            // ADD SERVICE PROVIDER DETAILS...
            if($serviceData[$i]->ServiceProviderId!=null){
                $user = new User();
                $serviceProviderId = $serviceData[$i]->ServiceProviderId;
                $spData = $user->where('UserId', '=', $serviceProviderId)->read();
                // REMOVE PASSWORD FIELD...
                unset($spData[0]->Password);
                $serviceData[$i]->ServiceProvider = $spData[0];
            }

            // ADD RATTING DETAILS...
            if(isset($serviceData[$i]->ServiceProvider)){
                $rating = new Rating();
                $serviceProviderId = $serviceData[$i]->ServiceProviderId;

                // **********CUSTOMER'S RATING**********
                $where = "RatingTo = {$serviceProviderId} AND RatingFrom = {$customerId}";
                $ratingData = $rating->where($where)->read();
                if(count($ratingData)>0){
                    $serviceData[$i]->Rating = $ratingData[0]->Ratings;
                    $serviceData[$i]->SPRated = true;
                }

                // **********AVERAGE RATING**********
                // $ratingData = $rating->where('RatingTo', '=', $serviceProviderId)->read();
                // if(count($ratingData)>0){
                //     // CHECK, BY CURRENT CUSTOMER RATING IS GIVEN OR NOT ?
                //     foreach($ratingData as $chunk){
                //         if($chunk->RatingFrom == $customerId){
                //             $serviceData[$i]->SPRated = true;
                //         }
                //     }
                //     $tempRating = 0;
                //     for($j=0; $j<count($ratingData); $j++){
                //         $tempRating += (float) $ratingData[$j]->Ratings;                        
                //     }
                //     $tempRating /= count($ratingData);
                //     $serviceData[$i]->Rating = $tempRating;
                // }                
            }
        }
        $res->status(200)->json($serviceData);
    }

    // ----------CURRENT SERVICES----------
    public function current_services(Request $req, Response $res){

        $customerId = session('userId');
        $service = new Service();
        $where = "UserId = {$customerId} AND (Status = {$this->ASSIGNED_STATUS} OR Status = {$this->NEW_STATUS})";
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')
                               ->where($where)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // MODIFY DATA...
        for($i=0; $i<count($serviceData); $i++){
            $serviceData[$i]->TotalCost   = (int) $serviceData[$i]->TotalCost;
            $serviceData[$i]->ServiceDate = date('d/m/Y', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->StartTime   = date('H:i', strtotime($serviceData[$i]->ServiceStartDate));
            $serviceData[$i]->Duration    = $serviceData[$i]->ServiceHours + $serviceData[$i]->ExtraHours;
            $serviceData[$i]->Duration    = date('H:i', mktime(0, $serviceData[$i]->Duration*60));
            $serviceData[$i]->EndTime     = time_to_minutes($serviceData[$i]->StartTime) 
                                          + time_to_minutes($serviceData[$i]->Duration);
            $serviceData[$i]->EndTime     = date('H:i', mktime(0, $serviceData[$i]->EndTime));

            // ADD EXTRA SERVICE DETAILS...
            $extra = new ExtraService();
            $serviceId = $serviceData[$i]->ServiceRequestId;
            $extraServiceData = $extra->where('ServiceRequestId', '=', $serviceId)->read();
            for($j=0; $j<count($extraServiceData); $j++){
                $serviceData[$i]->ExtraService[] = $extraServiceData[$j]->ServiceExtraId;                
            }

            // ADD SERVICE PROVIDER DETAILS...
            if($serviceData[$i]->ServiceProviderId!=null){
                $user = new User();
                $serviceProviderId = $serviceData[$i]->ServiceProviderId;
                $spData = $user->where('UserId', '=', $serviceProviderId)->read();
                // REMOVE PASSWORD FIELD...
                unset($spData[0]->Password);
                $serviceData[$i]->ServiceProvider = $spData[0];
            }

            // ADD RATTING DETAILS...(AVERAGE RATING...)
            if(isset($serviceData[$i]->ServiceProvider)){
                $rating = new Rating();
                $serviceProviderId = $serviceData[$i]->ServiceProviderId;
                $ratingData = $rating->where('RatingTo', '=', $serviceProviderId)->read();
                if(count($ratingData)>0){
                    // CHECK, BY CURRENT CUSTOMER RATING IS GIVEN OR NOT ?
                    // foreach($ratingData as $chunk){
                    //     if($chunk->RatingFrom == $customerId){
                    //         $serviceData[$i]->SPRated = true;
                    //     }
                    // }
                    $tempRating = 0;
                    for($j=0; $j<count($ratingData); $j++){
                        $tempRating += (float) $ratingData[$j]->Ratings;                        
                    }
                    $tempRating /= count($ratingData);
                    $serviceData[$i]->Rating = $tempRating;
                }                
            }
        }
        $res->status(200)->json($serviceData);
    }

    // ----------CANCEL SERVICE----------
    public function cancel_service(Request $req, Response $res){
        $serviceId = $req->params->id;
        $service = new Service();
        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'Status' => $this->CANCELLED_STATUS,
        ]);
        $res->status(200)->json(['message'=>'Service cancelled successfully.']);
    }
    
    // ----------RESCHEDULE SERVICE----------
    public function reschedule_service(Request $req, Response $res){

        // DATE & TIME PROPER VALIDATION PENDING...
        Validation::check($req->body, [
            'new_service_date' => ['required'],
            'new_service_time' => ['required']
        ]);

        $serviceId = $req->params->id;
        $date = $req->body->new_service_date;
        $time = $req->body->new_service_time;
        $serviceDate = date('Y-m-d H:i:s', strtotime($date.' '.$time));
        $service = new Service();

        $service->where('ServiceRequestId', '=', $serviceId)->update([
            'ServiceStartDate' => $serviceDate,
            'Status' => $this->NEW_STATUS
        ]);

        $res->status(200)->json(['message'=>'Service has been reschedule successfully.']);
    }

    // ----------RATE SERVICE PROVIDER----------
    public function rate_sp(Request $req, Response $res){

        Validation::check($req->body, [
            'arrival_rating' => ['required'],
            'friendly_rating' => ['required'],
            'quality_rating' => ['required'],
            'rating_feedback' => ['required'],
        ]);

        $serviceId = $req->params->id;
        $arrival_rating = (int) $req->body->arrival_rating;
        $quality_rating = (int) $req->body->quality_rating;
        $friendly_rating = (int) $req->body->friendly_rating;
        $rating_feedback = $req->body->rating_feedback;
        $averageRating =  (float) ($arrival_rating + $quality_rating + $friendly_rating )/3;

        $service = new Service();
        $data = $service->where('ServiceRequestId', '=', $serviceId)->read();
        $customerId = $data[0]->UserId;
        $serviceProviderId = $data[0]->ServiceProviderId;

        $rating = new Rating();
        $where = "RatingFrom = {$customerId} AND RatingTo = {$serviceProviderId}";
        if(!$rating->where($where)->exists()){
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
        else{
            // UPDATE OR EDIT RATING OR REVIEW...
            $where = "ServiceRequestId = {$serviceId}";
            $rating->where($where)->update([
                'Ratings' => $averageRating,
                'Comments' => $rating_feedback,
                'RatingDate' => date('Y-m-d H:i:s'),
                'OnTimeArrival' => $arrival_rating,
                'Friendly' => $friendly_rating,
                'QualityOfService' => $quality_rating,
            ]);            
            $res->status(200)->json(['message'=>'Thanks for feedback Us.']);    
            // $res->status(400)->json(['message'=>'You already given feedback!']);    
        }
    }

    // ----------CUSTOMER SP LIST---------- 
    // (WHO PROVIDED SERVICE TO CUSTOMER IN PAST...)
    public function my_service_provider(Request $req, Response $res){

        $customerId = session('userId');
        $service = new Service();
        $where = "UserId = {$customerId} AND Status = 2";
        $data = $service->columns(['ServiceProviderId'])->where($where)->read();

        $serviceProviders = [];
        for($i=0; $i<count($data); $i++){
            $serviceProviderId = $data[$i]->ServiceProviderId;

            // STORE FIRSTNAME AND LASTNAME OF SERVICE PROVIDER...
            $user = new User();
            $temp1 = $user->columns(['UserId, FirstName', 'LastName', 'UserProfilePicture'])
                          ->where('UserId', '=', $serviceProviderId)->read();
    
            // STORE FAVORITE AND BLOCKED DATA...
            $fav = new Favorite();
            $where = "UserId = {$customerId} AND TargetUserId = {$serviceProviderId}";
            $temp2 = $fav->columns(['UserId', 'IsFavorite', 'IsBlocked'])->where($where)->read();            
            if(count($temp2)>0){
                $temp1[0]->IsBlocked = $temp2[0]->IsBlocked;
                $temp1[0]->IsFavorite = $temp2[0]->IsFavorite;
            }

            // STORE RATING...
            $rating = new Rating();
            $temp3 = $rating->where('RatingTo', '=', $serviceProviderId)->read();
            if(count($temp3)>0){
                $tempRating = 0;
                for($j=0; $j<count($temp3); $j++){
                    $tempRating += (float) $temp3[$j]->Ratings;
                }
                $tempRating /= count($temp3); 
                $temp1[0]->Rating = $tempRating;
            }
            $serviceProviders[] = (array) $temp1[0];

        }    
        // REMOVE REPEATED OBJECT FROM ARRAY...
        $temp = array_unique(array_column($serviceProviders, 'UserId'));
        $serviceProviders = array_values(array_intersect_key($serviceProviders, $temp));
        $res->json($serviceProviders);    
    }

    // ----------ADD TO FAVORITE LIST----------
    public function add_to_favorite(Request $req, Response $res){
        $customerId = session('userId');
        $serviceProviderId = $req->params->id;   
        $fav = new Favorite();
        $where = "UserId = {$customerId} AND TargetUserId = {$serviceProviderId}";
        if($fav->where($where)->exists()){
            $fav->where($where)->update([
                'IsFavorite' => 1
            ]);    
        }
        else{
            $fav->create([
                'IsFavorite' => 1,
                'IsBlocked' => 0,
                'UserId' => $customerId,
                'TargetUserId' => $serviceProviderId
            ]);    
        }
        $res->status(200)->json(['message'=>'Added to favorite list']);
    }

    // ----------REMOVE FROM FAVORITE LIST----------
    public function remove_from_favorite(Request $req, Response $res){
        $customerId = session('userId');
        $serviceProviderId = $req->params->id;   
        $fav = new Favorite();
        $where = "UserId = {$customerId} AND TargetUserId = {$serviceProviderId}";
        if($fav->where($where)->exists()){
            $fav->where($where)->update([
                'IsFavorite' => 0
            ]);    
        }
        $res->status(200)->json(['message'=>'Remove from favorite list']);
    }

    // ----------BLOCK SP----------
    public function block_sp(Request $req, Response $res){
        $customerId = session('userId');
        $serviceProviderId = $req->params->id;   
        $fav = new Favorite();
        $where = "UserId = {$customerId} AND TargetUserId = {$serviceProviderId}";
        if($fav->where($where)->exists()){
            $fav->where($where)->update([
                'IsBlocked' => 1
            ]);    
        }
        else{
            $fav->create([
                'IsFavorite' => 0,
                'IsBlocked' => 1,
                'UserId' => $customerId,
                'TargetUserId' => $serviceProviderId
            ]);    
        }
        $res->status(200)->json(['message'=>'ServiceProvider blocked successfully.']);
    }

    // ----------UNBLOCK SP----------
    public function unblock_sp(Request $req, Response $res){
        $customerId = session('userId');
        $serviceProviderId = $req->params->id;   
        $fav = new Favorite();
        $where = "UserId = {$customerId} AND TargetUserId = {$serviceProviderId}";
        if($fav->where($where)->exists()){
            $fav->where($where)->update([
                'IsBlocked' => 0
            ]);    
        }
        $res->status(200)->json(['message'=>'ServiceProvider unblocked successfully.']);
    }
}
