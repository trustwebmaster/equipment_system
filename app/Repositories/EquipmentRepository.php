<?php

namespace App\Repositories;

use App\Interfaces\EquipmentInterface;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;

class EquipmentRepository implements EquipmentInterface
{
    public function saveEquipment(array $equipmentData) : Equipment
    {
        return Equipment::create([
           'name' => $equipmentData['name'] ,
            'status' => $equipmentData['type'],
            'date_of_acquisition' => $equipmentData['date']
        ]);

    }

    public function updateEquipment(array $equipmentData , string $equipmentId): void
    {
        Equipment::where('uid' , $equipmentId)->update([
                                'name' => $equipmentData['name'] ,
                                'status' => $equipmentData['type'],
                                'date_of_acquisition' => $equipmentData['date']
                            ]);

    }
    public function getEquipmentByDesc(): Collection
    {
        return Equipment::latest()->get();
    }

    public function getEquipmentById(string $equipmentId): ?Equipment
    {
        return Equipment::where('uid' , $equipmentId)->first();
    }



}
