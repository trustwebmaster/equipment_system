<?php

namespace App\Services;


use App\Models\EquipmentAllocation;
use App\Repositories\EquipmentAllocationRepository;
use App\Repositories\EquipmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
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

    /**
     * @return array
     */
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

    /**
     * @return Collection
     */
    public function getAllocatedEquipment(): Collection
    {
        return  $this->equipmentAllocationRepository->getAllocatedEquipment();
    }

    /**
     * @param string $allocationId
     * @return EquipmentAllocation
     */
    public function getAllocationById(string $allocationId): EquipmentAllocation
    {
        return  $this->equipmentAllocationRepository->getAllocationById($allocationId);
    }

    /**
     * @param array $allocationData
     * @param string $allocationId
     * @return void
     */
    public function updateAllocation(array $allocationData , string $allocationId): void
    {
         $this->equipmentAllocationRepository->updateAllocation($allocationData ,  $allocationId);
    }
}
