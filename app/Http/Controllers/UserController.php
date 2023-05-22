<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\ApiRepositoryInterface as api;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    public function __construct(Api $api)
    {
        $this->apiService = $api;
    }


    public function index(Request $request)
    {       
    }



    public function create()
    {
        
    }

    public function edit($id)
    {
        
    }


    public function store(UserRequest $req)
    {
       
    }



    public function update(UserRequest $req)
    {
       
    }


    public function getList(Request $request)
    {
        
    }


   
}
