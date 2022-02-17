<?php

namespace Database\Seeders;

use App\Models\Devices;
use App\Models\Patients;
use App\Models\Pharmacies;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10000; $i++) {
            $other_device_id = DB::table('devices')->where('device_brand','!=','Ubisson')->get()->random()->id;
            $our_device_id = DB::table('devices')->where('device_brand','=','Ubisson')->get()->random()->id;
            $patient_id =DB::table('patients')->get()->random()->id;
            $pharmacy_id = DB::table('pharmacies')->get()->random()->id;

            DB::table('exchange_records')->insert([
                'created_at' => $faker->dateTimeBetween('-5 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-5 years', 'now'),
                'other_device_id' => $other_device_id,
                'our_device_id' => $our_device_id,
                'patient_id' => $patient_id,
                'pharmacy_id' => $pharmacy_id,
                'other_device_serial_no' => $faker->numerify('SN-##########'),
                'our_device_serial_no' => $faker->numerify('SN-##########'),
                'other_device_serial_no_image' => '',
            ]);
            $device =  Devices::find($other_device_id);
            $device->total_exchanged +=1;
            $device->save();

            $device =  Devices::find($our_device_id);
            $device->total_exchanged +=1;
            $device->save();

            $patient = Patients::find($patient_id);
            $patient->total_exchanged +=1;
            $patient->save();

            $pharmacy = Pharmacies::find($pharmacy_id);
            $pharmacy->total_exchanged +=1;
            $pharmacy->save();

        }
    }
}
