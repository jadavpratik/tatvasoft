<?php

use core\Route;
use core\Database;
use app\services\Functions;

/**
 * RECREATE API WITH BELOW CONCEPTS...
 * 1.JOIN MULTIPLE TABLE 
 * 2.GROUP BY, 
 * 3.HAVING, 
 * 4.SUB QUERY
 */

Route::get('/test/customer/service/history', function($req, $res){
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate, 
                   service.TotalCost,
                   service.ExtraHours + service.ServiceHours AS Duration,
                   service.Comments,
                   service.HasPets,
                   service.Status,
                   address.AddressLine1,
                   address.AddressLine2,
                   address.PostalCode,
                   address.City,
                   address.Mobile,
                   address.Email,
                   rating.Ratings,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName,
                   CONCAT(serviceProvider.FirstName,' ',serviceProvider.LastName) AS ServiceProviderName,
                   serviceProvider.UserProfilePicture AS ServiceProviderProfilePicture,
                   GROUP_CONCAT(extraService.ServiceExtraId) AS ExtraService
            FROM servicerequest AS service
            INNER JOIN servicerequestaddress AS address
                ON service.ServiceRequestId = address.ServiceRequestId
            LEFT JOIN servicerequestextra AS extraService
                ON service.ServiceRequestId = extraService.ServiceRequestId
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            LEFT JOIN rating
                ON service.ServiceRequestId = rating.ServiceRequestId
            WHERE service.Status = 2 OR service.Status = 3
            GROUP BY extraService.ServiceRequestId
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        if($data[$i]->ExtraService!=null){
            $data[$i]->ExtraService = array_map('intval', explode(',', $data[$i]->ExtraService));
        }            
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
        $data[$i] = [
            'Service' => [
                'Id' => $data[$i]->ServiceRequestId,
                'ServiceDate' => $data[$i]->ServiceDate,
                'StartTime' => $data[$i]->StartTime,
                'EndTime' => $data[$i]->EndTime,
                'Duration' => $data[$i]->Duration,
                'TotalCost' => $data[$i]->TotalCost,
                'Comments' => $data[$i]->Comments,
                'HasPets' => $data[$i]->HasPets,
                'Status' => $data[$i]->Status,
                'ExtraService' => $data[$i]->ExtraService
            ],
            'ServiceAddress' => [
                'AddressLine1' => $data[$i]->AddressLine1,
                'AddressLine2' => $data[$i]->AddressLine2,
                'City' => $data[$i]->City,
                'PostalCode' => $data[$i]->PostalCode
            ],
            'Customer' => [
                'Id' => $data[$i]->CustomerId,
                'Name' => $data[$i]->CustomerName,
            ],
            'ServiceProvider' => [
                'Id' => $data[$i]->ServiceProviderId,
                'Name' => $data[$i]->ServiceProviderName,
                'ProfilePicture' => $data[$i]->ServiceProviderProfilePicture,
                'Ratings' => $data[$i]->Ratings
            ],
        ];
    }

    $res->status(200)->json($data);

});

Route::get('/test/customer/service/current', function($req, $res){
    // ONE ISSUE HOW TO GET AVARAGE RATING OF SERVICE PROVIDER?
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate, 
                   service.TotalCost,
                   service.ExtraHours + service.ServiceHours AS Duration,
                   service.Comments,
                   service.HasPets,
                   service.Status,
                   address.AddressLine1,
                   address.AddressLine2,
                   address.PostalCode,
                   address.City,
                   address.Mobile,
                   address.Email,
                   (SELECT ROUND(AVG(rating.Ratings), 2) FROM rating WHERE RatingTo = service.ServiceProviderId) as Ratings,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName,
                   CONCAT(serviceProvider.FirstName,' ',serviceProvider.LastName) AS ServiceProviderName,
                   serviceProvider.UserProfilePicture AS ServiceProviderProfilePicture,
                   GROUP_CONCAT(extraService.ServiceExtraId) AS ExtraService
            FROM servicerequest AS service
            INNER JOIN servicerequestaddress AS address
                ON service.ServiceRequestId = address.ServiceRequestId
            LEFT JOIN servicerequestextra AS extraService
                ON service.ServiceRequestId = extraService.ServiceRequestId
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            LEFT JOIN rating
                ON service.ServiceRequestId = rating.ServiceRequestId
            GROUP BY extraService.ServiceRequestId
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        if($data[$i]->ExtraService!=null){
            $data[$i]->ExtraService = array_map('intval', explode(',', $data[$i]->ExtraService));
        }            
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
        $data[$i] = [
            'Service' => [
                'Id' => $data[$i]->ServiceRequestId,
                'ServiceDate' => $data[$i]->ServiceDate,
                'StartTime' => $data[$i]->StartTime,
                'EndTime' => $data[$i]->EndTime,
                'Duration' => $data[$i]->Duration,
                'TotalCost' => $data[$i]->TotalCost,
                'Comments' => $data[$i]->Comments,
                'HasPets' => $data[$i]->HasPets,
                'Status' => $data[$i]->Status,
                'ExtraService' => $data[$i]->ExtraService
            ],
            'ServiceAddress' => [
                'AddressLine1' => $data[$i]->AddressLine1,
                'AddressLine2' => $data[$i]->AddressLine2,
                'City' => $data[$i]->City,
                'PostalCode' => $data[$i]->PostalCode
            ],
            'Customer' => [
                'Id' => $data[$i]->CustomerId,
                'Name' => $data[$i]->CustomerName,
            ],
            'ServiceProvider' => [
                'Id' => $data[$i]->ServiceProviderId,
                'Name' => $data[$i]->ServiceProviderName,
                'ProfilePicture' => $data[$i]->ServiceProviderProfilePicture,
                'Ratings' => $data[$i]->Ratings
            ],
        ];
    }

    $res->status(200)->json($data);

});

Route::get('/test/customer/sp', function($req, $res){
    $customerId = session('userId');
    $db = new Database();
    $sql = "SELECT service.ServiceProviderId,
                   CONCAT(serviceProvider.FirstName, ' ', serviceProvider.LastName) AS ServiceProviderName,
                   serviceProvider.UserProfilePicture AS ServiceProviderProfilePicture,
                   favorite_and_blocked.IsBlocked,
                   favorite_and_blocked.IsFavorite,
                   ROUND(AVG(rating.Ratings), 2) AS Ratings
            FROM servicerequest AS service
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            LEFT JOIN rating
                ON service.ServiceProviderId = rating.RatingTo
            LEFT JOIN favoriteandblocked AS favorite_and_blocked
                ON service.ServiceProviderId = favorite_and_blocked.TargetUserId
            WHERE service.UserId = {$customerId} AND service.Status = 2
            GROUP BY service.ServiceProviderId";
    $data = $db->query($sql);
    $res->status(200)->json($data);
});

Route::get('/test/sp-new-services', function($req, $res){
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate, 
                   service.TotalCost,
                   service.ExtraHours + service.ServiceHours AS Duration,
                   service.Comments,
                   service.HasPets,
                   service.Status,
                   address.AddressLine1,
                   address.AddressLine2,
                   address.PostalCode,
                   address.City,
                   address.Mobile,
                   address.Email,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName,
                   CONCAT(serviceProvider.FirstName,' ',serviceProvider.LastName) AS ServiceProviderName,
                   GROUP_CONCAT(extraService.ServiceExtraId) AS ExtraService
            FROM servicerequest AS service
            INNER JOIN servicerequestaddress AS address
                ON service.ServiceRequestId = address.ServiceRequestId
            LEFT JOIN servicerequestextra AS extraService
                ON service.ServiceRequestId = extraService.ServiceRequestId
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            WHERE service.Status = 0 
            GROUP BY extraService.ServiceRequestId
            HAVING (SELECT COUNT(*) FROM user 
                    LEFT JOIN useraddress AS address 
                    ON user.UserId = address.UserId WHERE address.PostalCode = 382424
                    )>0 AND 
                    (SELECT COUNT(*) FROM favoriteandblocked
                    WHERE (UserId = service.UserId AND TargetUserId = service.ServiceProviderId AND IsBlocked=1)
                    OR (TargetUserId = service.UserId AND UserId = service.ServiceProviderId AND IsBlocked=1)
                    )=0
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        if($data[$i]->ExtraService!=null){
            $data[$i]->ExtraService = array_map('intval', explode(',', $data[$i]->ExtraService));
        }            
        $data[$i]->IsExpired = strtotime($data[$i]->ServiceStartDate) < strtotime(date('Y-m-d H:i:s'))
                                ? 1 
                                : 0;
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
        $data[$i] = [
            'Service' => [
                'Id' => $data[$i]->ServiceRequestId,
                'ServiceDate' => $data[$i]->ServiceDate,
                'StartTime' => $data[$i]->StartTime,
                'EndTime' => $data[$i]->EndTime,
                'Duration' => $data[$i]->Duration,
                'TotalCost' => $data[$i]->TotalCost,
                'Comments' => $data[$i]->Comments,
                'HasPets' => $data[$i]->HasPets,
                'Status' => $data[$i]->Status,
                'ExtraService' => $data[$i]->ExtraService
            ],
            'ServiceAddress' => [
                'AddressLine1' => $data[$i]->AddressLine1,
                'AddressLine2' => $data[$i]->AddressLine2,
                'City' => $data[$i]->City,
                'PostalCode' => $data[$i]->PostalCode
            ],
            'Customer' => [
                'Id' => $data[$i]->CustomerId,
                'Name' => $data[$i]->CustomerName,
            ],
            'ServiceProvider' => [
                'Id' => $data[$i]->ServiceProviderId,
                'Name' => $data[$i]->ServiceProviderName,
            ],
        ];
    }


    $res->json($data);

});

Route::get('/test/sp-upcoming-services', function($req, $res){
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate, 
                   service.TotalCost,
                   service.ExtraHours + service.ServiceHours AS Duration,
                   service.Comments,
                   service.HasPets,
                   service.Status,
                   address.AddressLine1,
                   address.AddressLine2,
                   address.PostalCode,
                   address.City,
                   address.Mobile,
                   address.Email,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName,
                   CONCAT(serviceProvider.FirstName,' ',serviceProvider.LastName) AS ServiceProviderName,
                   GROUP_CONCAT(extraService.ServiceExtraId) AS ExtraService
            FROM servicerequest AS service
            INNER JOIN servicerequestaddress AS address
                ON service.ServiceRequestId = address.ServiceRequestId
            LEFT JOIN servicerequestextra AS extraService
                ON service.ServiceRequestId = extraService.ServiceRequestId
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            WHERE service.Status = 1 AND service.ServiceProviderId = 3
            GROUP BY extraService.ServiceRequestId
            HAVING (SELECT COUNT(*) FROM favoriteandblocked
                    WHERE (UserId = service.UserId AND TargetUserId = service.ServiceProviderId AND IsBlocked=1)
                    OR (TargetUserId = service.UserId AND UserId = service.ServiceProviderId AND IsBlocked=1)
                    )=0
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        if($data[$i]->ExtraService!=null){
            $data[$i]->ExtraService = array_map('intval', explode(',', $data[$i]->ExtraService));
        }            
        $data[$i]->IsExpired = strtotime($data[$i]->ServiceStartDate) < strtotime(date('Y-m-d H:i:s'))
                                ? 1 
                                : 0;
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
        $data[$i] = [
            'Service' => [
                'Id' => $data[$i]->ServiceRequestId,
                'ServiceDate' => $data[$i]->ServiceDate,
                'StartTime' => $data[$i]->StartTime,
                'EndTime' => $data[$i]->EndTime,
                'Duration' => $data[$i]->Duration,
                'TotalCost' => $data[$i]->TotalCost,
                'Comments' => $data[$i]->Comments,
                'HasPets' => $data[$i]->HasPets,
                'Status' => $data[$i]->Status,
                'ExtraService' => $data[$i]->ExtraService
            ],
            'ServiceAddress' => [
                'AddressLine1' => $data[$i]->AddressLine1,
                'AddressLine2' => $data[$i]->AddressLine2,
                'City' => $data[$i]->City,
                'PostalCode' => $data[$i]->PostalCode
            ],
            'Customer' => [
                'Id' => $data[$i]->CustomerId,
                'Name' => $data[$i]->CustomerName,
            ],
            'ServiceProvider' => [
                'Id' => $data[$i]->ServiceProviderId,
                'Name' => $data[$i]->ServiceProviderName,
            ],
        ];
    }
    $res->json($data);
});

Route::get('/test/sp-service-history', function($req, $res){
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate, 
                   service.TotalCost,
                   service.ExtraHours + service.ServiceHours AS Duration,
                   service.Comments,
                   service.HasPets,
                   service.Status,
                   address.AddressLine1,
                   address.AddressLine2,
                   address.PostalCode,
                   address.City,
                   address.Mobile,
                   address.Email,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName,
                   CONCAT(serviceProvider.FirstName,' ',serviceProvider.LastName) AS ServiceProviderName,
                   GROUP_CONCAT(extraService.ServiceExtraId) AS ExtraService
            FROM servicerequest AS service
            INNER JOIN servicerequestaddress AS address
                ON service.ServiceRequestId = address.ServiceRequestId
            LEFT JOIN servicerequestextra AS extraService
                ON service.ServiceRequestId = extraService.ServiceRequestId
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            WHERE (service.Status = 2 OR service.Status = 3) AND service.ServiceProviderId = 3
            GROUP BY extraService.ServiceRequestId
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        if($data[$i]->ExtraService!=null){
            $data[$i]->ExtraService = array_map('intval', explode(',', $data[$i]->ExtraService));
        }            
        $data[$i]->IsExpired = strtotime($data[$i]->ServiceStartDate) < strtotime(date('Y-m-d H:i:s'))
                                ? 1 
                                : 0;
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
        $data[$i] = [
            'Service' => [
                'Id' => $data[$i]->ServiceRequestId,
                'ServiceDate' => $data[$i]->ServiceDate,
                'StartTime' => $data[$i]->StartTime,
                'EndTime' => $data[$i]->EndTime,
                'Duration' => $data[$i]->Duration,
                'TotalCost' => $data[$i]->TotalCost,
                'Comments' => $data[$i]->Comments,
                'HasPets' => $data[$i]->HasPets,
                'Status' => $data[$i]->Status,
                'ExtraService' => $data[$i]->ExtraService
            ],
            'ServiceAddress' => [
                'AddressLine1' => $data[$i]->AddressLine1,
                'AddressLine2' => $data[$i]->AddressLine2,
                'City' => $data[$i]->City,
                'PostalCode' => $data[$i]->PostalCode
            ],
            'Customer' => [
                'Id' => $data[$i]->CustomerId,
                'Name' => $data[$i]->CustomerName,
            ],
            'ServiceProvider' => [
                'Id' => $data[$i]->ServiceProviderId,
                'Name' => $data[$i]->ServiceProviderName,
            ],
        ];
    }
    $res->json($data);
});

Route::get('/test/sp-my-rating', function($req, $res){
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate, 
                   service.TotalCost,
                   service.ExtraHours + service.ServiceHours AS Duration,
                   service.Comments,
                   service.HasPets,
                   service.Status,
                   address.AddressLine1,
                   address.AddressLine2,
                   address.PostalCode,
                   address.City,
                   address.Mobile,
                   address.Email,
                   rating.Ratings,
                   rating.Comments as Feedback,
                   rating.OnTimeArrival,
                   rating.QualityOfService,
                   rating.Friendly,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName,
                   CONCAT(serviceProvider.FirstName,' ',serviceProvider.LastName) AS ServiceProviderName,
                   GROUP_CONCAT(extraService.ServiceExtraId) AS ExtraService
            FROM servicerequest AS service
            INNER JOIN servicerequestaddress AS address
                ON service.ServiceRequestId = address.ServiceRequestId
            LEFT JOIN servicerequestextra AS extraService
                ON service.ServiceRequestId = extraService.ServiceRequestId
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN user AS serviceProvider
                ON service.ServiceProviderId = serviceProvider.UserId
            LEFT JOIN rating
                ON rating.ServiceRequestId = service.ServiceRequestId
            WHERE (service.Status = 2 OR service.Status = 3) AND service.ServiceProviderId = 3
            GROUP BY extraService.ServiceRequestId
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->TotalCost = (int) $data[$i]->TotalCost;
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        if($data[$i]->ExtraService!=null){
            $data[$i]->ExtraService = array_map('intval', explode(',', $data[$i]->ExtraService));
        }            
        $data[$i]->IsExpired = strtotime($data[$i]->ServiceStartDate) < strtotime(date('Y-m-d H:i:s'))
                                ? 1 
                                : 0;
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
        $data[$i] = [
            'Service' => [
                'Id' => $data[$i]->ServiceRequestId,
                'ServiceDate' => $data[$i]->ServiceDate,
                'StartTime' => $data[$i]->StartTime,
                'EndTime' => $data[$i]->EndTime,
                'Duration' => $data[$i]->Duration,
                'TotalCost' => $data[$i]->TotalCost,
                'Comments' => $data[$i]->Comments,
                'HasPets' => $data[$i]->HasPets,
                'Status' => $data[$i]->Status,
                'ExtraService' => $data[$i]->ExtraService
            ],
            'ServiceAddress' => [
                'AddressLine1' => $data[$i]->AddressLine1,
                'AddressLine2' => $data[$i]->AddressLine2,
                'City' => $data[$i]->City,
                'PostalCode' => $data[$i]->PostalCode
            ],
            'Customer' => [
                'Id' => $data[$i]->CustomerId,
                'Name' => $data[$i]->CustomerName,
            ],
            'ServiceProvider' => [
                'Id' => $data[$i]->ServiceProviderId,
                'Name' => $data[$i]->ServiceProviderName,
                'Rating' => [
                    'Ratings' => $data[$i]->Ratings,
                    'Feedback' => $data[$i]->Feedback,
                    'OnTimeArrival' => $data[$i]->OnTimeArrival,
                    'QualityOfService' => $data[$i]->QualityOfService,
                    'Friendly' => $data[$i]->Friendly
                ]
            ],
        ];
    }
    $res->json($data);
});

Route::get('/test/sp-service-schedule', function($req, $res){
    $db = new Database();
    $sql = "SELECT service.ServiceRequestId,
                   service.UserId AS CustomerId,
                   service.ServiceProviderId,
                   service.ServiceStartDate,
                   service.Status,
                   (service.ServiceHours + service.ExtraHours) AS Duration,
                   CONCAT(customer.FirstName,' ',customer.LastName) AS CustomerName
            FROM servicerequest AS service
            INNER JOIN user AS customer
                ON service.UserId = customer.UserId
            WHERE (service.Status = 0 OR service.Status = 1) AND service.ServiceProviderId = 3
            ORDER BY service.ServiceRequestId";

    $data = $db->query($sql);

    for($i=0; $i<count($data); $i++){
        $data[$i]->ServiceDate = date('d/m/Y', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->StartTime = date('H:i', strtotime($data[$i]->ServiceStartDate));
        $data[$i]->EndTime = date('H:i', strtotime("+".($data[$i]->Duration*60)." minutes", strtotime($data[$i]->ServiceStartDate)));
        $data[$i]->Duration = date('H:i', mktime(0, $data[$i]->Duration*60) );
        $data[$i]->IsExpired = strtotime($data[$i]->ServiceStartDate) < strtotime(date('Y-m-d H:i:s'))
                                ? 1 
                                : 0;
        if($data[$i]->IsExpired){
            unset($data[$i]);
        }    
        // ----------FOR MAKING DATA AS NESTED OBJECT----------
    }
    $res->json($data);

});

Route::get('/test/sp-my-customer', function($req, $res){
    $serviceProviderId = session('userId');
    $db = new Database();
    $sql = "SELECT service.UserId AS CustomerId,
                   CONCAT(customer.FirstName, ' ', customer.LastName) AS Name,
                   customer.UserProfilePicture AS ProfilePicture,
                   favorite_and_blocked.IsBlocked,
                   favorite_and_blocked.IsFavorite
            FROM servicerequest AS service
            LEFT JOIN user AS customer
                ON service.UserId = customer.UserId
            LEFT JOIN favoriteandblocked AS favorite_and_blocked
                ON service.ServiceProviderId = favorite_and_blocked.UserId
            WHERE service.ServiceProviderId = {$serviceProviderId} AND service.Status = 2
            GROUP BY service.UserId";
    $data = $db->query($sql);
    $res->status(200)->json($data);
});