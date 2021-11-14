<?php

namespace Library\database\seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('users')->insert([
            [
                'name' => 'joe',
                'email' => 'joe@doe.com',
                'password' => Hash::make('secret'),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
