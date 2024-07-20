<?php

namespace App\Interfaces;

interface UserInterface
{
    public function saveUser(array $userData);
    public function getUsersByDesc();
    public function getUser(string $userId);
    public function updateUser(array $userData , string $userId);
    public function getUsersWithoutAllocation();
    public function getUserRoles();

    public function removeCurrentUserRole(string $userId);

}
