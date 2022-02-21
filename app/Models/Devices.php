<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Devices extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'device_brand',
        'device_model',
        'is_active',
        'total_exchanged',
    ];

    public function exchange(): BelongsTo
    {
        return $this->belongsTo(ExchangeRecords::class,);
    }
}
