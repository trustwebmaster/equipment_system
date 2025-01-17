<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected UserRepository $userRepository;
    protected Hasher $hasher;

    public function __construct(UserRepository $userRepository, Hasher $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    /**
     * Create a new user.
     *
     * @param array $userData
     * @return void
     * @throws \Exception
     */
    public function createUser(array $userData): void
    {
        try {
            $userData['password'] = $this->hashPassword($userData['password']);
            $user = $this->userRepository->saveUser($userData);

            $user->assignRole($userData['role']);

            event(new Registered($user));
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing user.
     *
     * @param array $userData
     * @param string $userId
     * @return void
     * @throws \Exception
     */
    public function updateUser(array $userData, string $userId): void
    {
        try {

            $userData['password'] = $this->hashPassword($userData['password']);

            $this->userRepository->updateUser($userData, $userId);

            $this->userRepository->removeCurrentUserRole($userId);

            $user = $this->userRepository->getUser($userId);

            $user->assignRole($userData['role']);

        } catch (ModelNotFoundException $e) {
            Log::error('User not found: ' . $userId);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to update user: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Retrieve all users in descending order.
     *
     * @return Collection
     */
    public function getUsersByDesc(): Collection
    {
        return $this->userRepository->getUsersByDesc();
    }

    public function getUserRoles(): \Illuminate\Support\Collection
    {
        return $this->userRepository->getUserRoles();
    }

    /**
     * Retrieve a single user by ID.
     *
     * @param string $userId
     * @return mixed
     */
    public function getUser(string $userId): mixed
    {
        try {
            return $this->userRepository->getUser($userId);
        } catch (ModelNotFoundException $e) {
            Log::error('User not found: ' . $userId);
            throw $e;
        }
    }

    /**
     * Delete a user by ID.
     *
     * @param string $userId
     * @return void
     * @throws \Exception
     */
    public function deleteUser(string $userId): void
    {
        try {
            $user = $this->getUser($userId);
            $user->delete();
        } catch (\Exception $e) {
            Log::error('Failed to delete user: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Hash a password.
     *
     * @param string $password
     * @return string
     */
    private function hashPassword(string $password): string
    {
        return $this->hasher->make($password);
    }
}
