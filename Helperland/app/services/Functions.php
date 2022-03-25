<?php

namespace app\services;

use app\models\User;
use app\models\Favorite;
use app\models\Service;
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