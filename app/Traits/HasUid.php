<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
trait HasUid
{
    protected static function bootHasUid(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->uid)) {
                $model->uid = Str::orderedUuid();
            }
        });
    }
}
