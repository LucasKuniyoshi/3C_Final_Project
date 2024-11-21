<?php
namespace App\Domains\AuthDomain\Repositories;

use App\Domains\UserDomain\Models\User;


class AuthRepository
{

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}

