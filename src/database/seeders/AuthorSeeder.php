<?php

namespace Library\database\seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('authors')->insert([
            [
                'name' => 'Fedor',
                'surname' => 'Dostoievski',
                'country' => 'Rusia',
                'language' => 'Ruso',
                'birth_date' => '1821-11-11',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Gabriel',
                'surname' => 'García Márquez',
                'country' => 'México',
                'language' => 'Español',
                'birth_date' => '1927-03-6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Ramón María',
                'surname' => 'del Valle-Inclán',
                'country' => 'España',
                'language' => 'Español',
                'birth_date' => '1866-10-28',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
