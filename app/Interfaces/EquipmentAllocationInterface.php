<?php

namespace App\Interfaces;

interface EquipmentAllocationInterface
{
    public function assignAllocation(array $allocationData);
    public function getAllocations();


}
