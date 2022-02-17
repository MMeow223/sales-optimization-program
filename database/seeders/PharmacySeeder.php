<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $accounts = [
            [
                'account_no' => '123456789',
                'name' => 'Pharmacy 1',
                'address' => 'Jalan Sibu',
                'phone' => '0125136849',
                'email' => 'pharmacy1@gmail.com',
                'city' => 'Sibu',
                'state' => 'Sarawak',
                'postcode' => '11000',
                'pic' => '15255555',
            ],
            [
                'account_no' => '987654321',
                'name' => 'Pharmacy 2',
                'address' => 'Jalan Kuching',
                'phone' => '01152666649',
                'email' => 'pharmacy2@gmail.com',
                'city' => 'Kuching',
                'state' => 'Sarawak',
                'postcode' => '22000',
                'pic' => '17755545',
            ]

        ];
        for($i = 0; $i < count($accounts); $i++) {
            DB::table('pharmacies')->insert([
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'pharmacy_account_no' => $accounts[$i]['account_no'],
                'pharmacy_name' => $accounts[$i]['name'],
                'pharmacy_address_1' => $accounts[$i]['address'],
                'pharmacy_address_2' => $accounts[$i]['address'],
                'pharmacy_city' => $accounts[$i]['city'],
                'pharmacy_state' => $accounts[$i]['state'],
                'pharmacy_postcode' => $accounts[$i]['postcode'],
                'pharmacy_pic' => $accounts[$i]['pic'],
                'pharmacy_phone' => $accounts[$i]['phone'],
                'is_active' => 1,
                'total_exchanged' => 0

            ]);
        }
    }
}
