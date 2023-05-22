<?php

namespace App\Services;

interface ApiRepositoryInterface
{
    public function addUser($data);
    public function listUser($data); 
    public function editUser($data);
}
