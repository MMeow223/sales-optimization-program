<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRecords extends Model
{
    use HasFactory;

    public function other_device_id()
    {
        return $this->hasOne(Device::class, 'foreign_key');
    }
    public function our_device_id()
    {
        return $this->hasOne(Device::class, 'foreign_key');
    }
    public function patient_id()
    {
        return $this->hasOne(Patients::class, 'foreign_key');
    }
    public function pharmacy_id()
    {
        return $this->hasOne(Pharmacies::class, 'foreign_key');
    }

}
