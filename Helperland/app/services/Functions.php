<?php

namespace app\services;

use app\models\User;
use app\models\Favorite;
use app\models\Service;

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
    
    // ----------GET EMAIL BY USERID----------
    public function getEmailByUserId($id){
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
    public function getDetailsByUserId($id){
        $user = new User();
        $data = $user->where('UserId', '=', $id)->read();
        if(count($data)>0){
            return $data[0];
        }
        else{
            return false;
        }
    }

    // ----------GET SP_EMAILS BY POSTALCODE----------
    public function getSPEmailsByPostalCode($postal_code){
        $user = new User();
        $where = "PostalCode = {$postal_code} AND RoleId = 2";
        $data = $user->columns(['user.Email', 'user.UserId'])->join('UserId', 'UserId', 'useraddress')->where($where)->read();
        if(count($data)>0){
            $emails  = [];
            foreach($data as $i){
                if(!$this->isSPBlockedByCustomer($i->UserId)){
                    $emails[] = $i->Email;
                }
            }
            return $emails;
        }
        else{
            return false;
        }
    }

    // ----------GET SP_EMAILS FOR RESCHEDULE SERVICE BY SERVICE ID----------
    public function getSPEmailsByServiceId($id){
        $serviceId = $id;
        $service = new Service();
        $data = $service->where('servicerequest.ServiceRequestId', '=', $serviceId)
                        ->join('ServiceRequestId', 'ServiceRequestId', 'servicerequestaddress')->read();
        
        if($data[0]->ServiceProviderId!=0){
            // ALREADY ASSIGNED SP EMAIL
            $serviceProviderId = $data[0]->ServiceProviderId;
            if(!$this->isSPBlockedByCustomer($serviceProviderId)){
                $user = new User();
                $data = $user->where('UserId', '=', $serviceProviderId)->read();
                return [$data[0]->Email];    
            }
            else{
                exit();
            }
        }
        else{
            // NEW REQUEST FURTHER RESCHEDULE SO THAT EMAILS BY POSTAL CODE
            $postal_code = $data[0]->PostalCode;
            $user = new User();
            $where = "useraddress.PostalCode = {$postal_code} AND user.RoleId = 2";
            $data = $user->join('UserId', 'UserId', 'useraddress')
                         ->where($where)
                         ->read();
            $emails = [];
            foreach($data as $i){
                if(!$this->isSPBlockedByCustomer($i->UserId)){
                    $emails[] = $i->Email;
                }
            }
            if(count($emails)>0){
                return $emails;
            }
            else{
                exit();
            }
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

    // ----------CHECK THE SP IS BLOCKED BY CUSTOMER----------
    public function isSPBlockedByCustomer($id){
        $customerId = session('userId');
        $serviceProviderId = $id;
        $favorite = new Favorite();
        $where = "UserId = {$customerId} AND TargetUserId = {$serviceProviderId}";
        $data = $favorite->where($where)->read();
        if(count($data)>0){
            if($data[0]->IsBlocked==1){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    // ----------CHECK THE CUSTOMER IS BLOCKED BY SP----------
    public function isCustomerBlockedBySP($id){
        $serviceProviderId = session('userId');
        $customerId = $id;
        $favorite = new Favorite();
        $where = "UserId = {$serviceProviderId} AND TargetUserId = {$customerId}";
        $data = $favorite->where($where)->read();
        if(count($data)>0){
            if($data[0]->IsBlocked==1){
                return true;
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