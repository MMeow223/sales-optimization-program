<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $brand = array('Brand 1', 'Brand 2','Brand 3','Brand 4','Brand 5', 'Ubisson');
        $model = array('Model 1', 'Model 2','Model 3');

        for ($i = 0; $i < count($brand); $i++) {
            for ($j = 0; $j < count($model); $j++) {
                DB::table('devices')->insert([
                    'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
                    'device_brand' => $brand[$i],
                    'device_model' => $model[$j],
                    'is_active' => $faker->boolean,
                    'total_exchanged' => 0
                ]);
            }
        }
    }
}
