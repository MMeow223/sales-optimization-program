<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([

            'username' => 'elvis',
            'email' => 'elviswonsg2002@hotmail.com',
            'password' => bcrypt('elvis'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
