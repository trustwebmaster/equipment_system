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
           'model' => $equipmentData['model'] ,
           'type' => $equipmentData['equipment_type'] ,
            'status' => $equipmentData['type'],
            'date_of_acquisition' => $equipmentData['date']
        ]);

    }

    public function updateEquipment(array $equipmentData , string $equipmentId): void
    {
        Equipment::where('uid' , $equipmentId)->update([
                                'name' => $equipmentData['name'] ,
                                'model' => $equipmentData['model'] ,
                                'type' => $equipmentData['equipment_type'] ,
                                'status' => $equipmentData['type'],
                                'date_of_acquisition' => $equipmentData['date']
                            ]);

    }
    public function getEquipmentByDesc(): Collection
    {
        return Equipment::latest()->get();
    }

    public function getEquipmentWithoutAllocation(): Collection
    {
        return Equipment::doesntHave('user_allocation')->orWhereHas('user_allocation', function ($query) {
                                        $query->whereNotNull('return_date');
                                    })->get();
    }

    public function getEquipmentById(string $equipmentId): ?Equipment
    {
        return Equipment::where('uid' , $equipmentId)->first();
    }

    public function getEquipmentStatus(string $equipmentId): ?string
    {
        return Equipment::where('id' , $equipmentId)->first()->value('status');
    }



}
