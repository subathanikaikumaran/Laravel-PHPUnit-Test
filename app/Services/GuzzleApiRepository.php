<?php

namespace App\Services;

use App\Services\HttpConnection;
use Illuminate\Support\Facades\Config;
use App\Services\ApiFieldList;
use Illuminate\Support\Facades\Session;

class GuzzleApiRepository implements ApiRepositoryInterface
{


    public function addUser($data){        
        if(!empty($data)){
            $userId = "1003";
        } else {
            $userId = "";
        }
        return $userId;
    }

    public function listUser($data){        
        if(!empty($data)){
            $userId = "1003";
        } else {
            $userId = "";
        }
        return $userId;
    } 
    public function editUser($data){        
        if(!empty($data)){
            $userId = "1003";
        } else {
            $userId = "";
        }
        return $userId;
    }
    
}
