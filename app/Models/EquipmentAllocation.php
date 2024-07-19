<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentAllocation extends Model
{
    use HasFactory , HasUid , SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
       return $this->belongsTo(User::class , 'user_id');
    }

    public function equipment(): BelongsTo
    {
       return $this->belongsTo(Equipment::class , 'equipment_id');
    }

}
