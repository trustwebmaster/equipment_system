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

    public function updateUser(array $userData , string $userId) : void
    {
        $hashedPassword = $this->hashPassword($userData['password']);

        $this->userRepository->updateUser($userData , $userId , $hashedPassword);

    }

    /**
     * @return mixed
     */
    public function getUsersByDesc(): mixed
    {
        return $this->userRepository->getUsersByDesc();
    }

    public function getUser(string $userId)
    {
        return $this->userRepository->getUser($userId);
    }

    public function deleteUser(string $userId): void
    {
        $user = $this->getUser($userId);
        $user->delete();

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
