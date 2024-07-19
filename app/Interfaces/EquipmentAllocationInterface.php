<?php

namespace App\Interfaces;

interface EquipmentAllocationInterface
{
    public function assignAllocation(array $allocationData);
    public function getAllocations();
    public function getAllocatedEquipment();
    public function getAllocationById(string $allocationId);
    public function updateAllocation(array $allocationData , $allocationId);


}
