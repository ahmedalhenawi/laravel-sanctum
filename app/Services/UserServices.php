<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserServices{

    public function createUser(array $data) : User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}
