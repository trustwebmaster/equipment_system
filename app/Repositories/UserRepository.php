<?php

namespace  App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepository implements  UserInterface
{

    public function saveUser(array $userData): User
    {
        return  User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => $userData['password']
                ]);

    }

    public function getUsersByDesc() : Collection
    {
        return User::with('roles')->latest()->get();
    }

    public function getUserRoles() : \Illuminate\Support\Collection
    {
        return Role::all()->pluck('name');
    }

    public function updateUser(array $userData , string $userId): void
    {
          User::where('uid' , $userId)->update([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password']
        ]);

    }

    public function getUser(string $userId) : ?User
    {
        return User::where('uid', $userId)->first();

    }

    public function removeCurrentUserRole(string $userId) : void
    {
        $user = User::where('uid', $userId)->first();
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

    }

    public function getUsersWithoutAllocation() : Collection
    {
        return User::doesntHave('allocation')->orWhereHas('allocation', function ($query) {
            $query->whereNotNull('return_date');
        })->get();

    }

}
