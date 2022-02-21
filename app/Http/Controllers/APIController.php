<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\ExchangeRecords;
use App\Models\Patients;
use App\Models\Pharmacies;

class APIController extends Controller
{
    public function getPatients(){
            $query = Patients::select(
                'id',
                'patient_name',
                'patient_dob',
                'patient_email',
                'patient_postcode',
                'patient_phone',
                'patient_diabetes_type',
                'created_at'
            );

            return datatables($query)->make(true);
    }
    public function getExchanges(){

        $query = ExchangeRecords::with([
                'other_device' => function($q){
                    $q->select('id','device_brand','device_model')->get();
                },
                'our_device' => function($q){
                    $q->select('id','device_model')->get();
                },
                'patient' => function($q){
                    $q->select('id','patient_name')->get();
                },
            ]
            );

        return datatables($query)->make(true);

    }

    public function getDevices(){
        $query = Devices::select(
            'id',
            'device_brand',
            'device_model',
            'created_at',
            'is_active',
        );


        return datatables($query)->make(true);
    }
    public function getPharmacies()
    {

        $query = Pharmacies::select(
            'id',
            'pharmacy_name',
            'pharmacy_account_no',
            'pharmacy_pic',
            'pharmacy_phone',
            'is_active',
        );

        return datatables($query)->make(true);
    }
}
