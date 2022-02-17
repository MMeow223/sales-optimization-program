<?php

namespace Database\Seeders;

use App\Models\Devices;
use App\Models\ExchangeRecords;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PatientSeeder::class,
            PharmacySeeder::class,
            DeviceSeeder::class,
            ExchangeRecordSeeder::class,
            AccountSeeder::class,
        ]);

//         \App\Models\User::factory(10)->create();
    }

}
