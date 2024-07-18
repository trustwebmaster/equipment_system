<?php

namespace  App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements  UserInterface
{

    /**
     * @param array $userData
     * @param string $hashedPassword
     * @return mixed
     */
    public function saveUser(array $userData , string $hashedPassword): mixed
    {
        return  User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => $hashedPassword
                ]);

    }

    public function getUsersByDesc()
    {
        return User::latest()->get();
    }

    public function updateUser(array $userData , string $userId , string $hashedPassword) : void
    {
        User::where('uid' , $userId)->update([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $hashedPassword
        ]);

    }

    public function getUser(string $userId)
    {
        return User::where('uid' , $userId)->first();
    }

}
