<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();
        $brand = array('Brand1', 'Brand 2', 'Brand 3', 'Brand 4', 'Brand 5', 'Brand 6', 'Brand 7', 'Brand 8', 'Brand 9', 'Brand 10');
        $model = array('Model1', 'Model 2', 'Model 3', 'Model 4', 'Model 5', 'Model 6', 'Model 7', 'Model 8', 'Model 9', 'Model 10');
        $exchangemodel = array('Exchange Model1', 'Exchange Model 2', 'Exchange Model 3', 'Exchange Model 4', 'Exchange Model 5', 'Exchange Model 6', 'Exchange Model 7', 'Exchange Model 8', 'Exchange Model 9', 'Exchange Model 10');
        $state = array('Sarawak', 'Kuala Lumpur', 'Selangor', 'Johor', 'Perak', 'Kedah', 'Perlis', 'Pahang', 'Terengganu', 'Kelantan', 'Melaka', 'Negeri Sembilan', 'Pulau Pinang', 'Sabah', 'Sarawak', 'Labuan', 'Putrajaya');
        $diabetestype = array('No Diabetes', 'Type 1', 'Type 2', 'Type 3', 'Type 4', 'Type 5', 'Type 6', 'Type 7', 'Type 8', 'Type 9', 'Type 10');


        for ($i = 0; $i < 100; $i++) {
            DB::table('exchanges')->insert([
                // insert random data into every column of the table

                'brand' => $brand[array_rand($brand)],
                'model' => $model[array_rand($model)],
                'serial_no' => $faker->numerify('SN-##########'),
                'exchange_model' => $exchangemodel[array_rand($exchangemodel)],
                'exchange_serial_no' => $faker->numerify('SN-##########'),
                'serial_no_image' => "",
                'created_at' => Date::createFromDate(2022, rand(1, 12), rand(1, 28))->format('Y-m-d H:i:s'),
                //                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::createFromDate(2022, rand(1, 12), rand(1, 28))->format('Y-m-d H:i:s'),
                'patient_name' => $faker->name(),
                'patient_dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'patient_phone_no' => $faker->phoneNumber(),
                'patient_email' => Str::random(10) . '@gmail.com',
                'patient_addr_1' => $faker->address(),
                'patient_addr_2' => $faker->address(),
                'patient_city' => $faker->city(),
                'patient_state' =>  $state[array_rand($state)],
                'patient_zipcode' => $faker->numerify('#####'),
                'patient_diabetes' => $diabetestype[array_rand($diabetestype)],
                'pharmacy_name' => $faker->company(),
                'pharmacy_account_no' => $faker->numerify('ACC-##########'),
                'pharmacy_addr_1' => $faker->address(),
                'pharmacy_addr_2' => $faker->address(),
                'pharmacy_city' => $faker->city(),
                'pharmacy_state' => $state[array_rand($state)],
                'pharmacy_zipcode' => $faker->numerify('#####'),
                'pharmacy_pic' => $faker->numerify('PIC-##########'),
                'pharmacy_contact' => $faker->phoneNumber(),

            ]);
        }
    }
}
