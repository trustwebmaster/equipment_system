<?php

namespace App\Policies;

use App\Models\EquipmentAllocation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class EquipmentAllocationPolicy
{

    public function before(User $user): bool
    {
        return $user->hasRole('company-admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EquipmentAllocation $equipmentAllocation): bool
    {
        return $user->id == $equipmentAllocation->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function assign(User $user): bool
    {
        return $user->can('assign equipment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function unassign(User $user, EquipmentAllocation $equipmentAllocation): bool
    {
        return $user->can('unassign equipment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function return(User $user, EquipmentAllocation $equipmentAllocation): bool
    {
        return $user->id == $equipmentAllocation->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function viewReturns(User $user, EquipmentAllocation $equipmentAllocation): bool
    {
        return $user->can('view equipment returns');

    }
}
