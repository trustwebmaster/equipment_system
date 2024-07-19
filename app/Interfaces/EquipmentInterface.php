<?php

namespace App\Interfaces;

interface EquipmentInterface
{
    public function saveEquipment(array $equipmentData);
    public function updateEquipment(array $equipmentData , string $equipmentId);
    public function getEquipmentByDesc();
    public function getEquipmentById(string $equipmentId);



}
