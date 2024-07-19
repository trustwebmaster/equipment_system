<?php

namespace App\Repositories;

use App\Interfaces\EquipmentAllocationInterface;
use App\Models\EquipmentAllocation;
use Illuminate\Database\Eloquent\Collection;

class EquipmentAllocationRepository implements EquipmentAllocationInterface
{

    public function assignAllocation(array $allocationData): void
    {
        EquipmentAllocation::create([
            'user_id' => $allocationData['user'],
            'equipment_id' => $allocationData['equipment'],
            'date_of_allocation' => $allocationData['date'],
            'allocation_equipment_status' => $allocationData['status'],
        ]);
    }

    public function getAllocations(): Collection
    {
        return EquipmentAllocation::with(['user', 'equipment'])->get();

    }
}
