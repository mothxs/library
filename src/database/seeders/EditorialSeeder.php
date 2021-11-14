<?php

namespace Library\database\seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('editorials')->insert([
            [
                'name' => 'Porrúa',
                'country' => 'México',
                'foundation_date' => '1996-10-23',
                'website' => 'https://porrua.mx/',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Acen',
                'country' => 'España',
                'foundation_date' => '2010-07-12',
                'website' => 'https://aceneditorial.es/',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Lenizdat',
                'country' => 'Rusia',
                'foundation_date' => '1930-02-23',
                'website' => 'http://lenizdatgroup.ru/',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
