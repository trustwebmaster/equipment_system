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

    public function updateAllocation(array $allocationData , $allocationId): void
    {
        EquipmentAllocation::where('uid' , $allocationId)->update([
            'notes' => $allocationData['notes'],
            'return_date' => $allocationData['date'],
            'return_equipment_status' => $allocationData['condition'],
        ]);
    }

    public function getAllocations(): Collection
    {
        return EquipmentAllocation::with(['user', 'equipment'])->whereNull('return_date')->get();

    }

    public function getAllocatedEquipment(): Collection
    {
        return EquipmentAllocation::with(['user', 'equipment'])->whereNotNull('return_date')->get();
    }

    public function getAllocationById(string $allocationId): EquipmentAllocation
    {
        return EquipmentAllocation::whereUid($allocationId)->first();
    }
}
