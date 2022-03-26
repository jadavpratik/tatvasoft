<?php

namespace app\services;

use app\models\User;
use app\models\Favorite;
use app\models\Service;
use app\models\ExtraService;
use app\models\Token;

class Functions{

    // ----------SET USER ROLE_NAME----------
    public function setUserRoleName($roleId){
		switch($roleId){
			case 1:
				return 'customer';
			case 2:
				return 'service-provider';
			case 3:
				return 'admin';
		}
	}

    // ----------GET TOKEN BY USERID----------
    public function getVerificationLinkByUserId($userId){
        $_token = bin2hex(random_bytes(16));
        $token = new Token();
        $token->create(['userId' => $userId, 'token' => $_token]);
        $link = BASE_URL."/user/verify/{$_token}/{$userId}";
        return $link;
    }
    
    // ----------GET EMAIL BY USERID----------
    public function getUserEmailByUserId($id){
        $user = new User();
        $data = $user->where('UserId', '=', $id)->read();
        if(count($data)>0){
            return $data[0]->Email;
        }
        else{
            return false;
        }
    }

    // ----------GET DETAILS BY USERID----------
    public function getUserDetailsByUserId($id){
        $user = new User();
        $data = $user->where('UserId', '=', $id)->read();
        if(count($data)>0){
            return $data[0];
        }
        else{
            return false;
        }
    }

    // ----------GET SP EMAILS BY POSTAL CODE----------
    public function getSPEmailsByPostalCode($postal_code){
        $user = new User();
        $where = "PostalCode = {$postal_code} AND RoleId = 2";
        $data = $user->columns(['user.Email', 'user.UserId'])->join('UserId', 'UserId', 'useraddress')->where($where)->read();
        if(count($data)>0){
            $emails  = [];
            foreach($data as $i){
                if(!$this->isUserBlockedByAnotherUser($i->UserId)){
                    $emails[] = $i->Email;
                }
            }
            return $emails;
        }
        else{
            return false;
        }
    }

    // ----------GET CUSTOMER EMAIL BY SERVICE ID----------
    public function getCustomerEmailByServiceId($id){
        $serviceId = $id;
        $service = new Service();
        $data = $service->join('UserId', 'UserId', 'user')->where('servicerequest.ServiceRequestId', '=', $serviceId)->read();
        if(count($data)==1){
            return $data[0]->Email;
        }
        else{
            return null;
        }
    }

    // ----------GET SP EMAIL BY SERVICE ID----------
    public function getSPEmailByServiceId($id){
        $serviceId = $id;
        $service = new Service();
        $data = $service->join('ServiceProviderId', 'UserId', 'user')->where('servicerequest.ServiceRequestId', '=', $serviceId)->read();
        if(count($data)==1){
            return $data[0]->Email;
        }
        else{
            return null;
        }
    }

    // ----------GET SP EMAIL BY SERVICE ID----------
    public function getServiceDetailsByServiceId($id){
        $serviceId = $id;
        $service = new Service();
        $serviceData = $service->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')
                        ->where('servicerequest.ServiceRequestId', '=', $serviceId)->read();

        function time_to_minutes($time){
            $temp = explode(':', $time);
            $hours = (int) $temp[0];
            $minutes = (int) $temp[1];
            $totalMinutes = $hours*60 + $minutes;
            return $totalMinutes;
        }

        // ADD CUSTOMER NAME AND EMAIL...
        $user = new User();
        $userData = $user->where('UserId', '=', $serviceData[0]->UserId)->read();
        $serviceData[0]->CustomerName = $userData[0]->FirstName.' '.$userData[0]->LastName;

        // MODIFY DATA...
        $serviceData[0]->TotalCost   = (int) $serviceData[0]->TotalCost;
        $serviceData[0]->ServiceDate = date('d/m/Y', strtotime($serviceData[0]->ServiceStartDate));
        $serviceData[0]->StartTime   = date('H:i', strtotime($serviceData[0]->ServiceStartDate));
        $serviceData[0]->Duration    = $serviceData[0]->ServiceHours 
                                        + $serviceData[0]->ExtraHours;
        $serviceData[0]->Duration    = date('H:i', mktime(0, $serviceData[0]->Duration*60));
        $serviceData[0]->EndTime     = time_to_minutes($serviceData[0]->StartTime) 
                                        + time_to_minutes($serviceData[0]->Duration);
        $serviceData[0]->EndTime     = date('H:i', mktime(0, $serviceData[0]->EndTime));
        $serviceData[0]->HasPets     = $serviceData[0]->HasPets==0? 'No' : 'Yes';

        // ADD EXTRA SERVICE DETAILS...
        $extra = new ExtraService();
        $extraServiceData = $extra->where('ServiceRequestId', '=', $serviceId)->read();
        if(count($extraServiceData)>0){
            $serviceData[0]->ExtraService = '';
            for($j=0; $j<count($extraServiceData); $j++){
                if($extraServiceData[$j]->ServiceExtraId==1){
                    $serviceData[0]->ExtraService .= 'Cabinets, ';
                }
                else if($extraServiceData[$j]->ServiceExtraId==2){
                    $serviceData[0]->ExtraService .= 'Fridge, ';
                }
                else if($extraServiceData[$j]->ServiceExtraId==3){
                    $serviceData[0]->ExtraService .= 'Oven, ';
                }
                else if($extraServiceData[$j]->ServiceExtraId==4){
                    $serviceData[0]->ExtraService .= 'Laundry Wash, ';
                }
                else if($extraServiceData[$j]->ServiceExtraId==5){
                    $serviceData[0]->ExtraService .= 'Interior Windows, ';
                }
            }    
            $serviceData[0]->ExtraService = rtrim($serviceData[0]->ExtraService, ', ');
        }
                
        return $serviceData[0];
    }

    // ----------CHECK USER BLOCKED ANOTHER USER----------
    public function isUserBlockedByAnotherUser($id){
        $user1 = session('userId');
        $user2 = $id;
        $favorite = new Favorite();

        $where1 = "(UserId = {$user2} AND TargetUserId = {$user1})";
        $data1 = $favorite->where($where1)->read();

        $where2 = "(UserId = {$user1} AND TargetUserId = {$user2})";
        $data2 = $favorite->where($where2)->read();
        
        if(count($data1)>0 || count($data2)>0){
            if(isset($data1[0]->IsBlocked)){
                if($data1[0]->IsBlocked==1){
                    return true;
                }
            }
            if(isset($data2[0]->IsBlocked)){
                if($data2[0]->IsBlocked==1){
                    return true;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

}