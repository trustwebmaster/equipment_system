<?php

namespace App\Interfaces;

interface UserInterface
{
    public function saveUser(array $userData , string $hashedPassword);

    public function getUsersByDesc();
}
