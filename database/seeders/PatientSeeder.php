<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Factory::create();
        $state = array('Sarawak', 'Kuala Lumpur', 'Selangor', 'Johor', 'Perak', 'Kedah', 'Perlis', 'Pahang', 'Terengganu', 'Kelantan', 'Melaka', 'Negeri Sembilan', 'Pulau Pinang', 'Sabah', 'Sarawak', 'Labuan', 'Putrajaya');
        $diabetes_type = array('No Diabetes', 'Type 1', 'Type 2', 'Type 3', 'Type 4', 'Type 5', 'Type 6', 'Type 7', 'Type 8', 'Type 9', 'Type 10');


        for ($i = 0; $i < 100; $i++) {
            DB::table('patients')->insert([
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'patient_name' => $faker->name,
                'patient_dob' => $faker->date,
                'patient_email' => $faker->email,
                'patient_address_1' => $faker->address,
                'patient_address_2' => $faker->address,
                'patient_city' => $faker->city,
                'patient_state' => $state[array_rand($state)],
                'patient_postcode' => $faker->postcode,
                'patient_phone' => $faker->phoneNumber,
                'patient_diabetes_type' => $diabetes_type[array_rand($diabetes_type)],
                'total_exchanged' => 0

            ]);
        }
    }
}
