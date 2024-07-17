<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserService
{

    protected  UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $userData
     * @return void
     */
    public function createUser(array $userData): void
    {
        $hashedPassword = $this->hashPassword($userData['password']);
        $user  = $this->userRepository->saveUser($userData, $hashedPassword);
        event(new Registered($user));
    }


    /**
     * @return mixed
     */
    public function getUsersByDesc(): mixed
    {
        return $this->userRepository->getUsersByDesc();
    }

    /**
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
       return  Hash::make($password);
    }
}
