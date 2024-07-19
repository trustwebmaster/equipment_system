<?php

namespace App\Services;

use App\Repositories\EquipmentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class EquipmentService
{
    protected EquipmentRepository $equipmentRepository;

    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    /**
     * Create a new equipment.
     *
     * @param array $equipmentData
     * @return void
     * @throws \Exception
     */
    public function createEquipment(array $equipmentData): void
    {
        try {

            $this->equipmentRepository->saveEquipment($equipmentData);

        } catch (\Exception $e) {
            Log::error('Failed to create equipment: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing equipment.
     *
     * @param array $equipmentData
     * @param string $equipmentId
     * @return void
     * @throws \Exception
     */
    public function updateEquipment(array $equipmentData, string $equipmentId): void
    {
        try {
            $this->equipmentRepository->updateEquipment($equipmentData, $equipmentId);
        }
        catch (\Exception $e) {
            Log::error('Failed to update equipment: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Retrieve all equipment in descending order.
     *
     * @return Collection
     */
    public function getEquipmentByDesc(): Collection
    {
        return $this->equipmentRepository->getEquipmentByDesc();
    }

    /**
     * Retrieve a single equipment by ID.
     *
     * @param string $equipmentId
     * @return mixed
     */
    public function getEquipmentById(string $equipmentId): mixed
    {
        try {
            return $this->equipmentRepository->getEquipmentById($equipmentId);
        } catch (ModelNotFoundException $e) {
            Log::error('Equipment not found: ' . $equipmentId);
            throw $e;
        }
    }

    /**
     * Delete equipment by ID.
     *
     * @param string $equipmentId
     * @return void
     * @throws \Exception
     */
    public function deleteEquipment(string $equipmentId): void
    {
        try {
            $equipment = $this->getEquipmentById($equipmentId);
            $equipment->delete();
        } catch (\Exception $e) {
            Log::error('Failed to delete equipment: ' . $e->getMessage());
            throw $e;
        }
    }

}
