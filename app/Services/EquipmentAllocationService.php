<?php

namespace App\Services;


use App\Repositories\EquipmentAllocationRepository;
use App\Repositories\EquipmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class EquipmentAllocationService
{

    protected EquipmentAllocationRepository $equipmentAllocationRepository;
    protected EquipmentRepository $equipmentRepository;
    protected UserRepository $userRepository;

    public function __construct(EquipmentAllocationRepository $equipmentAllocationRepository , EquipmentRepository $equipmentRepository , UserRepository $userRepository)
    {
        $this->equipmentAllocationRepository = $equipmentAllocationRepository;
        $this->equipmentRepository = $equipmentRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $allocationData
     * @return void
     * @throws \Exception
     */
    public function assignAllocation(array $allocationData): void
    {
        try {

            $allocationData['status'] = $this->equipmentRepository->getEquipmentStatus($allocationData['equipment']);

            $this->equipmentAllocationRepository->assignAllocation($allocationData);

        } catch (\Exception $e) {
            Log::error('Failed to create equipment: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getAllocationData(): array
    {
        $users  =  $this->userRepository->getUsersWithoutAllocation();
        $equipments = $this->equipmentRepository->getEquipmentWithoutAllocation();
        $allocations  = $this->equipmentAllocationRepository->getAllocations();

         return [
             'users' => $users,
             'equipments' => $equipments ,
             'allocations' => $allocations
         ];
    }
}
