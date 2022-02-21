<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRecords extends Model
{
    use HasFactory;


    public function other_device(){

        return $this->hasOne(Devices::class,'id','other_device_id');
    }

    public function our_device(){
        return $this->hasOne(Devices::class,'id','our_device_id');
    }

    public function patient(){
        return $this->hasOne(Patients::class,'id','patient_id');
    }

    public function pharmacy(){
        return $this->hasOne(Pharmacies::class,'id','pharmacy_id');
    }


}
