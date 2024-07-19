<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory , HasUid , SoftDeletes;

    protected $guarded = [];

    public function user_allocation(): HasOne
    {
        return $this->hasOne(EquipmentAllocation::class , 'equipment_id');
    }

}
